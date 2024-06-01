-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: doteams
-- ------------------------------------------------------
-- Server version	8.0.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `templates`
--

DROP TABLE IF EXISTS `templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `skills` longtext,
  `experience` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `templates`
--

LOCK TABLES `templates` WRITE;
/*!40000 ALTER TABLE `templates` DISABLE KEYS */;
INSERT INTO `templates` VALUES (1,'Системный аналитик','Java, ORM, Аналитическое мышление, Системное мышление, Управление требованиями, Моделирование бизнес-процессов, SQL, UML, BPMN, Agile, Scrum, Коммуникабельность, Работа в команде,  Управление временем, Решение проблем, Критическое мышление,  Документирование, Техническая грамотность, Знание предметной области,  Визуализация данных,  Презентационные навыки,  Ведение переговоров,  Тестирование ПО,  Английский язык',6.3),(2,'Java разработчик','Java Core, ООП, Структуры данных, Многопоточность, Обработка исключений, Работа с сетью, Лямбда-выражения, Stream API, Java EE/Jakarta EE, Servlets, JSP, JSF, WebSockets, Enterprise JavaBeans (EJB), Java Message Service (JMS), Contexts and Dependency Injection (CDI), Spring Framework, Spring Core, Spring MVC, Spring Boot, Spring Data, Spring Security, Hibernate/JPA, Объектно-реляционное отображение, JPQL, Criteria API, SQL, MySQL, PostgreSQL, Oracle, NoSQL, MongoDB, Cassandra, HTML, CSS, JavaScript, JavaScript-фреймворки, React, Angular, Vue.js, REST API, IntelliJ IDEA, Eclipse, Maven, Gradle, Git, JUnit, Mockito, DevOps, Docker, Kubernetes, Cloud Computing, AWS, Azure, GCP, Микросервисная архитектура, Agile/Scrum, Аналитическое мышление, Умение решать проблемы, Самостоятельность, Ответственность, Работа в команде, Коммуникабельность, Желание учиться и развиваться',5.1),(3,'Frontend разработчик','HTML, CSS, JavaScript,  DOM, React, Angular, Vue.js,  Redux,  TypeScript, Webpack,  Git,  Responsive Web Design,  Cross-browser compatibility,  SEO optimization,  Accessibility,  Testing (Jest, Enzyme),  User Interface (UI) Design,  User Experience (UX) Design,  Agile/Scrum,  Problem-solving skills,  Communication skills,  Teamwork,  Creativity,  Analytical thinking,  Attention to detail,  Continuous learning, CSS-препроцессоры (Sass, Less), методологии CSS ( BEM,  OOCSS),  JavaScript-библиотеки (jQuery, Lodash),  Gulp/Grunt,  HTTP, REST API,  JSON,  XML,  Progressive Web Apps (PWA),  Performance optimization,  Debugging skills,  Version control systems (Git, SVN),  Command line interface (CLI),  Agile methodologies (Kanban),  Cross-functional collaboration,  Time management',1.4);
/*!40000 ALTER TABLE `templates` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-01 13:42:21
