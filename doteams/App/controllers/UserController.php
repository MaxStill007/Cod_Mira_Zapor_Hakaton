<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;

class UserController{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function create(){
        loadView('register');
    }
    public function login(){
        loadView('login');
    }

    // public function store(){
    //     $allowedFields = ['name', 'email', 'password', 'password_confirmation'];
    //     $newUserData = array_intersect_key($_POST, array_flip($allowedFields));
    //     $newUserData = array_map('sanitize', $newUserData);

    //     $errors = [];

    //     if(!Validation::email($newUserData['email'])){
    //         $errors['email'] = 'Был введен неверный email';
    //     }
    //     if(!Validation::string($newUserData['name'], 2, 50)){
    //         $errors['name'] = 'Имя должно быть длинной от 2 до 50 символов';
    //     }
    //     if(!Validation::string($newUserData['password'], 6, 50)){
    //         $errors['password'] = 'Пароль должен быть длинной от 6 до 50 символов';
    //     }
    //     if(!Validation::match($newUserData['password'], $newUserData['password_confirmation'])){
    //         $errors['password_confirmation'] = 'Пароли не совпадают';
    //     }

    //     $userStore = $newUserData;

    //     if(!empty($errors)){
    //         loadView('register', [
    //             'errors' => $errors,
    //             'userStore' => $userStore
    //         ]);
    //         return;
    //     }

    //     $params = [
    //         'email' => $newUserData['email']
    //     ];

    //     $user = $this->db->sql('SELECT * FROM users WHERE email = :email', $params)->fetch();

    //     if($user){
    //         $errors['email'] = 'Пользователь с данным email уже зарегистрирован';
    //         loadView('register', [
    //             'errors' => $errors,
    //             'userStore' => $userStore
    //         ]);
    //         return;
    //     }

    //     $sqlFields = [];
    //     foreach($newUserData as $userKey => $userValue){
    //         if($userKey == 'password_confirmation') continue;
    //         $sqlFields[] = $userKey;
    //     }
    //     $sqlFields = implode(', ', $sqlFields);

    //     $sqlValues = [];
    //     foreach($newUserData as $userKey => $userValue){
    //         if($userKey == 'password_confirmation') continue;
    //         $sqlValues[] = ':' . $userKey;
    //     }
    //     $sqlValues = implode(', ', $sqlValues);
    //     $newUserData['password'] = password_hash($newUserData['password'], PASSWORD_DEFAULT);
    //     unset($newUserData['password_confirmation']);
    //     $this->db->sql("INSERT INTO users ({$sqlFields}) VALUES ({$sqlValues})", $newUserData);

    //     //Получить ID нового пользователя
    //     $userId = $this->db->connection->lastInsertId();

    //     Session::set('user', [
    //         'id' => $userId,
    //         'name' => $newUserData['name'],
    //         'email' => $newUserData['email'],

    //     ]);

    //     redirect('/resume');
    // }

    public function logout(){
        Session::clearAll();
        $cookiePath = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $cookiePath['path'], $cookiePath['domain']);
        redirect('/login');
    }

    public function authorize(){
        $email = $_POST['email'];
        $password = $_POST['password'];
        sanitize($email);
        sanitize($password);

        $errors = [];

        if(!Validation::email($email)){
            $errors['email'] = 'Неправильный email или пароль';
        }
        if(!Validation::string($password, 6, 50)){
            $errors['email'] = 'Неправильный email или пароль';
        }

        if(!empty($errors)){
            loadView('login', [
                'errors' => $errors,
                'email' => $email
            ]);
            return;
        }

        $params = [
            'email' => $email
        ];

        $user = $this->db->sql("SELECT * FROM users WHERE email = :email", $params)->fetch();

        if(!$user){
            $errors['email'] = 'Неправильный email или пароль';
            loadView('login', [
                'errors' => $errors
            ]);
            return;
        }

        if($password != $user['password']){
            $errors['email'] = 'Неправильный email или пароль';
            loadView('login', [
                'errors' => $errors
            ]);
            return;
        }

        Session::set('user', [
            'id' => $user['user_id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
        ]);

        redirect('/resume');
    }
}