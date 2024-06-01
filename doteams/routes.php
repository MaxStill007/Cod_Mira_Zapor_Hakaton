<?php

$router->get('/', 'EntryController@entry');


$router->get('/resume', 'ResumeController@index', ['auth']);
$router->get('/resume/create', 'ResumeController@create', ['auth']);
$router->get('/resume/{id}', 'ResumeController@show', ['auth']);
$router->get('/resume/edit/{id}', 'ResumeController@edit', ['auth']);


$router->get('/templates', 'ResumeController@templates', ['auth']);
$router->get('/template/{id}', 'ResumeController@template', ['auth']);
$router->get('/createTemplate', 'ResumeController@createTemplate', ['auth']);


$router->post('/resume', 'ResumeController@store', ['auth']);
$router->delete('/resume/{id}', 'ResumeController@destroy', ['auth']);
$router->put('/resume/{id}', 'ResumeController@update', ['auth']);
$router->put('/resume/status/{id}', 'ResumeController@status', ['auth']);
$router->put('/template/{id}', 'ResumeController@updateTemplate', ['auth']);

$router->get('/register', 'UserController@create', ['guest']);
$router->get('/login', 'UserController@login', ['guest']);

$router->post('/register', 'UserController@store', ['guest']);
$router->post('/login', 'UserController@authorize', ['guest']);

$router->post('/logout', 'UserController@logout', ['auth']);