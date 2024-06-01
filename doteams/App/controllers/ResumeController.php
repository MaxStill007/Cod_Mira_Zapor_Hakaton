<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;

class ResumeController{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index(){
        $resumes = $this->db->sql('SELECT * FROM resumes')->fetchAll();
        $counter = 0;
        loadView('index', [
            'resumes' => $resumes,
            'counter' => $counter
        ]);
    }

    public function templates(){
        $templates = $this->db->sql('SELECT * FROM templates')->fetchAll();
        loadView('templates', [
            'templates' => $templates
        ]);
    }


    public function template($params){
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $template = $this->db->sql('SELECT * FROM templates WHERE id=:id', $params)->fetch();
        if(!$template){
            ErrorController::notFound('Резюме не найдено');
            return;
        }
        loadView('template', [
            'template' => $template
        ]);
    }

    public function createTemplate(){
        loadView('createTemplate');
    }


    public function create(){
        loadView('create');
    }



    public function store(){
        $allowedFields = ['name', 'status', 'resume_file'];
        $newResumeData = array_intersect_key($_POST, array_flip($allowedFields));
        $newResumeData = array_map('sanitize', $newResumeData);
        $newResumeData['status'] = 0;
        
        if(empty($newResumeData['name'])){
            $errors['name'] = 'Поле с именем должно быть заполнено';
        }
        if(!Validation::string($newResumeData['name'],10)){
        $errors['name'] = 'Поле с именем должно быть длинной от 10 символов';
        }

        if(!empty($errors)){
            loadView('create', [
                'errors' => $errors,
                'resume' => $newResumeData
            ]);
            return;
        } else{
        $newResumeData['resume_file'] = $_FILES['file']['name'];
        $sqlFields = [];
        foreach($newResumeData as $resumeKey => $resumeValue){
            $sqlFields[] = $resumeKey;
        }
        $sqlFields = implode(', ', $sqlFields);
        $sqlValues = [];
        foreach($newResumeData as $resumeKey => $resumeValue){
            if($resumeValue === ''){
                $newResumeData[$resumeKey] = null;
            }
            $sqlValues[] = ':' . $resumeKey;
        }
        $sqlValues = implode(', ', $sqlValues);
        // inspectAndDie($_FILES);
        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/resumes/' . $_FILES['file']['name']);
        $sql = "INSERT INTO resumes ({$sqlFields}) VALUES ({$sqlValues})";
        $this->db->sql($sql, $newResumeData);
        //ПЕРЕХОД НА ПИТОН
        shell_exec('python D:/PyCharm/Projects/ggg/bb.py');
        // $statistics = $this->db->sql('SELECT * FROM resumes ORDER BY id DESC LIMIT 1')->fetch();
        // $templates = $this->db->sql('SELECT * FROM templates')->fetchAll();
        // foreach($templates as $template){
        //     $skills = explode(", ", $statistics['']);
        // }
        $_SESSION['success_message'] = 'Резюме успешно добавлено в список';
        redirect('/resume');
        }
    }





    public function show($params){
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $resume = $this->db->sql('SELECT * FROM resumes WHERE id=:id', $params)->fetch();
        $templates = $this->db->sql('SELECT * FROM templates')->fetchall();
        if(!$resume){
            ErrorController::notFound('Резюме не найдено');
            return;
        }
        $percents = explode(", ", $resume['percents']);
        loadView('show', [
            'resume' => $resume,
            'percents' => $percents,
            'templates' => $templates
        ]);
    }




    public function destroy($params){
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $resume = $this->db->sql('SELECT * FROM resumes WHERE id=:id', $params)->fetch();
        if(!$resume){
            ErrorController::notFound('Резюме не найдено');
            return;
        }
        if(Session::get('user')['id'] !== $resume['user_id']){
            $_SESSION['error_message'] = 'Вы не имеете доступа к изменению этой задачи';
            redirect('/resume/' . $resume['id']);
            return;
        }
        $this->db->sql('DELETE FROM resumes WHERE id=:id', $params);
        $_SESSION['success_message'] = 'Задача успешно удалена';
        redirect('/resume');
    }




    public function edit($params){
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $resume = $this->db->sql('SELECT * FROM resumes WHERE id=:id', $params)->fetch();
        if(!$resume){
            ErrorController::notFound();
            return;
        }
        if(Session::get('user')['id'] !== $resume['user_id']){
            $_SESSION['error_message'] = 'Вы не имеете доступа к изменению этого резюме';
            redirect('/resume/' . $resume['id']);
            return;
        }
        loadView('edit', [
            'resume' => $resume
        ]);
    }




    public function update($params){
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $resume = $this->db->sql('SELECT * FROM resumes WHERE id=:id', $params)->fetch();
        if(!$resume){
            ErrorController::notFound();
            return;
        }
        // if(Session::get('user')['id'] !== $resume['user_id']){
        //     $_SESSION['error_message'] = 'Вы не имеете доступа к изменению этого резюме';
        //     redirect('/resume/' . $resume['id']);
        //     return;
        // }
        $allowedFields = ['name', 'status', 'skills', 'experience', 'email', 'phone', 'positions'];
        
        $updatedResumeData = array_intersect_key($_POST, array_flip($allowedFields));
        $updatedResumeData = array_map('sanitize', $updatedResumeData);

        //Валидация
        // $requiredFields = ['title','deadline'];
        // $errors = [];
        // foreach($requiredFields as $requiredField){
        //     if(empty($updatedResumeData[$requiredField])){
        //         $errors['empty'] = '';
        //         break;
        //     }
        // }
        if(empty($newResumeData['name'])){
            $errors['name'] = 'Поле с именем должно быть заполнено';
        }
        if(!Validation::string($newResumeData['name'],10)){
        $errors['name'] = 'Поле с именем должно быть длинной от 10 символов';
        }
        if(!empty($errors)){
            loadView('edit', [
                'errors' => $errors,
                'resume' => $resume
            ]);
        } else{
        $updatedFields = [];
        foreach($updatedResumeData as $updatedKey => $updatedValue){
            $updatedFields[] = "{$updatedKey} = :{$updatedKey}";
        }
        $updatedFields = implode(', ', $updatedFields);

        $sql = "UPDATE resumes SET $updatedFields where id = :id";
        $updatedResumeData['id'] = $id;
        $this->db->sql($sql, $updatedResumeData);
        }
        
        $_SESSION['success_message'] = 'Профиль соискателя успешно изменен';
        redirect('/resume/' . $id);
    }


 


    public function updateTemplate($params){
        $id = $params['id'] ?? '';
        $params = [
            'id' => $id
        ];
        $template = $this->db->sql('SELECT * FROM templates WHERE id=:id', $params)->fetch();
        if(!$template){
            ErrorController::notFound();
            return;
        }
        $allowedFields = ['name', 'skills', 'experience'];
        
        $updatedTemplateData = array_intersect_key($_POST, array_flip($allowedFields));
        $updatedTemplateData = array_map('sanitize', $updatedTemplateData);
        $updatedFields = [];
        foreach($updatedTemplateData as $updatedKey => $updatedValue){
            $updatedFields[] = "{$updatedKey} = :{$updatedKey}";
        }
        $updatedFields = implode(', ', $updatedFields);

        $sql = "UPDATE templates SET $updatedFields where id = :id";
        $updatedTemplateData['id'] = $id;
        $this->db->sql($sql, $updatedTemplateData);

        $_SESSION['success_message'] = 'Шаблон успешно изменен';
        redirect('/template/' . $id);
    }


    
   


    // public function status($params){
    //     $id = $params['id'] ?? '';
    //     $params = [
    //         'id' => $id
    //     ];
    //     $resume = $this->db->sql('SELECT * FROM resumes WHERE id=:id', $params)->fetch();
    //     if(!$resume){
    //         ErrorController::notFound();
    //         return;
    //     }
    //     if(Session::get('user')['id'] !== $resume['user_id']){
    //         $_SESSION['error_message'] = 'Вы не имеете доступа к изменению этой задачи';
    //         redirect('/resume/' . $resume['id']);
    //         return;
    //     }
    //     if($resume['status'] === 0){
    //     $this->db->sql('UPDATE resume SET status = 1 where id = :id', $params);
    //     $_SESSION['success_message'] = 'Задача успешно завершена';
    //     } else {
    //     $this->db->sql('UPDATE resume SET status = 0 where id = :id', $params);
    //     $_SESSION['success_message'] = 'Задача успешно возобновлена';
    //     }
        
    //     redirect('/resume');
    // }
}