<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// ✅ Routes WITHOUT the 'api' prefix
$router->get('/users', 'UserController@index'); // Get all users
$router->get('/users/{id}', 'UserController@show'); // Get user by ID
$router->post('/users', 'UserController@store');
$router->post('/users', 'UserController@add');
$router->put('/users/{id}', 'UserController@update'); // Update user
$router->patch('/users/{id}', 'UserController@update'); // Partial update
$router->delete('/users/{id}', 'UserController@destroy'); // Delete user
$router->delete('/users/{id}', 'UserController@delete');

$router->get('/usersjob', 'UserJobController@index'); // Get all user jobs
$router->get('/userjob/{id}', 'UserJobController@show'); // Get user job by ID

// ✅ Test route
$router->get('/test', function () {
    return response()->json(['message' => 'Test route is working!'], 200);
});
