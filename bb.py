import fitz
import mysql.connector
import pdfminer.pdfparser
import pdfminer.pdfdocument
import pdfminer.pdfpage
#import pdfminer.pdfpagecontent
import spacy
from spacy.matcher import Matcher
from spacy.tokens import Span
from pathlib import Path
import docx2txt
import pandas as pd
import csv
from sqlalchemy import create_engine
import re
import os

skills_file = "D:/PyCharm/Projects/ggg/skills.csv"


def convert_doc_to_text(file):
    """Конвертирует .doc и .docx файлы в текст."""
    text = docx2txt.process(file)
    return text


nlp = spacy.load("ru_core_news_sm")

matcher = Matcher(nlp.vocab)

# Паттерны для поиска ключевых слов:

patterns_fio = [
    [{"POS": "PROPN"}, {"POS": "PROPN"}, {"POS": "PROPN"}, {"OP": "!"}],
    [{"IS_TITLE": True}, {"IS_TITLE": True}, {"TEXT": {"REGEX": r"(ович|евна|ич|ыч)$"}}]
]

matcher.add("FIO", patterns_fio)


def extract_text_from_pdf(pdf_file):
    """Извлекает текст из PDF-файла."""
    with fitz.open(pdf_file) as doc:
        text = ""
        for page in doc:
            text += page.get_text()
    return text


def extract_info_from_text(text):
    doc = nlp(text)

    matches = matcher(doc)

    extracted_info = {}

    # noun_chunks = list(nlp_eng.noun_chunks)

    for match_id, start, end in matches:
        matched_span = doc[start:end].text
        match_key = nlp.vocab.strings[match_id]  # Получаем ключ паттерна

        if match_key not in extracted_info:
            extracted_info[match_key] = []
        extracted_info[match_key].append(matched_span)

    def extract_email(text):
        email = re.findall(r"([^@|\s]+@[^@]+\.[^@|\s]+)", text)
        if email:
            try:
                return email[0].split()[0].strip(';')
            except IndexError:
                return None

    def parse_phone_number(text):
        se = r'\+?\d{1,3}[-.\s]?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{2}[-.\s]?\d{2}'
        phone_numbers = re.findall(se, text)
        if phone_numbers:
            try:
                return phone_numbers
            except IndexError:
                return None

    def find_skills(file_name, text):
        with open(file_name, 'r') as file:
            skills = file.read().split(',')
        found_skills = []
        for skill in skills:
            if skill.lower() in text.lower():
                found_skills.append(skill)
        return found_skills

    def extract_work_experience(text):
        match = re.search(r"Опыт работы[:\s]*(.*)", text, re.IGNORECASE)
        if match:
            return match.group(1).strip()
        else:
            return None

    extracted_info["email"] = extract_email(text)
    extracted_info["mobile_number"] = parse_phone_number(text)
    extracted_info["skill"] = find_skills(skills_file, text)
    extracted_info["ex"] = extract_work_experience(text)

    return extracted_info

try:
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="123456",
        database='doteams'
    )
    cursor = connection.cursor()
    id = cursor.execute('SELECT id FROM resumes ORDER BY id DESC LIMIT 1')
    id = cursor.fetchone()
    nn = cursor.execute(f'SELECT resume_file FROM resumes WHERE id={id[0]}')
    nn = cursor.fetchone()

    # Загрузка резюме
    file = f"D:/laragon/www/doteams/public/resumes/{nn[0]}"
    if Path(file).suffix == ".pdf":
        text = extract_text_from_pdf(file)
    elif Path(file).suffix == ".doc" or ".docx":
        text = convert_doc_to_text(file)
    elif Path(file).suffix == ".txt":
        pass
    #print(text)
    # Извлечение информации
    extracted_data = extract_info_from_text(text)

    # Вывод информации
    name = extracted_data["FIO"]
    email = extracted_data["email"]
    mob = extracted_data["mobile_number"]
    skill = extracted_data["skill"]
    ex = extracted_data["ex"]

    if isinstance(name, list):
        name = name[0]
    if isinstance(email, list):
        email = email[0]
    if isinstance(mob, list):
        mob = mob[0]
    # Обработка ex:
    if isinstance(skill, list):
        separator = ", "
        skill_us = separator.join(str(element) for element in skill)

    match = re.search(r'\d+', ex)
    if match:
        ex = int(match.group(0))
    else:
        ex = '0'

    crit1 = cursor.execute(f'SELECT skills,experience FROM templates WHERE id=1')
    crit1 = cursor.fetchone()
    crit2 = cursor.execute(f'SELECT skills,experience FROM templates WHERE id=2')
    crit2 = cursor.fetchone()
    crit3 = cursor.execute(f'SELECT skills,experience FROM templates WHERE id=3')
    crit3 = cursor.fetchone()

    our_skills = skill_us.split(", ")
    template_skills1 = crit1[0].split(", ")
    template_skills2 = crit2[0].split(", ")
    template_skills3 = crit3[0].split(", ")

    similarities1 = set(our_skills).intersection(set(template_skills1))
    similarities2 = set(our_skills).intersection(set(template_skills2))
    similarities3 = set(our_skills).intersection(set(template_skills3))

    points1 = 0
    if (float(ex) >= crit1[1]):
        points1 += 1

    points1 += len(similarities1)*10
    points1 = points1/(len(template_skills1)+1)
    if (points1 > 1):
        points1 = 1

    points2 = 0
    if (float(ex) >= crit1[1]):
        points2 += 1
    points2 += len(similarities2)*10
    points2 = points2 / len(template_skills2)
    if (points2 > 1):
        points2 = 1

    points3 = 0
    if (float(ex) >= crit1[1]):
        points3 += 1
    points3 += len(similarities3)*10
    points3 = points3 / len(template_skills3)
    if (points3 > 1):
        points3 = 1

    points1 = int(float(points1) * 100.0)
    points2 = int(float(points2) * 100.0)
    points3 = int(float(points3) * 100.0)

    string_proc = ""
    string_proc = str(points1) + ", " + str(points2) + ", " + str(points3)
    # Обновление записи в resumes:
    cursor.execute(
        f"UPDATE resumes SET name = %s, status = %s, skills = %s, experience = %s, email = %s, phone = %s, positions = %s, percents = %s WHERE id = %s",
        (name, "0", skill_us, ex, email, mob, "None", string_proc, id[0])
    )
    connection.commit()


except mysql.connector.Error as e:
    print(e)

