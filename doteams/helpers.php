<?php

//Чтоб не прописывать полный путь от диска к файлу

function basePath($path = ''){
    return __DIR__ . '/' . $path;
}

/**
 * Функция для загрузки вида страницы с доступом к данным
 * $name - название вида
 * $data - динамические данные (из бдхи)
 */
function loadView($name, $data= []){
    $viewPath = basePath("App/views/{$name}.view.php");
    if(file_exists($viewPath)){
        extract($data);
        require $viewPath;
    }
    else echo "View {$name} not found";
}

//Для поиска ошибок (осмотр объекта)
    function inspectAndDie($value){
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
    }


  function redirect($url){
    header("Location: {$url}");
    exit;
    }


    function sanitize($data){
        return filter_var(trim($data), FILTER_SANITIZE_SPECIAL_CHARS);
    }