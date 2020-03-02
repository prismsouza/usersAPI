<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/api/users', "UsersController@getAll");

$router->group(['prefix' => "/api/user"], function () use ($router) {
    $router->get("/id/{id}", "UsersController@getById"); // listar um registro específico
    $router->get("/{number}", "UsersController@getByNumber"); // listar um registro específico
    $router->post("/", "UsersController@post"); // inserir um novo registro
    $router->put("/id/{id}", "UsersController@update"); // atualizar um registro específico
    $router->delete("/{id}", "UsersController@destroy"); // deleta um registro específico
});

$router->get('/api/upload', "UsersController@showForm");
$router->post('/api/upload', "UsersController@store");