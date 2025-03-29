<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function ()use ($router){
    $router->get('/users',['uses' => 'UserController@getUsers']);
});

$router->get('/users', 'UserController@getUsers'); // Get all users
$router->get('/users/{id}', 'UserController@show'); // Get user by ID
$router->post('/users', 'UserController@add'); // Create new user
$router->put('/users/{id}', 'UserController@update'); // Update user
$router->patch('/users/{id}', 'UserController@update'); // Partial update
$router->delete('/users/{id}', 'UserController@delete'); // Delete user

$router->get('/usersjob', 'UserJobController@index'); // Get all user jobs
$router->get('/userjob/{id}', 'UserJobController@show'); // Get user job by ID