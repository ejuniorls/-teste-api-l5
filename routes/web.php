<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/people', 'PeopleController@index');
    $router->get('/people/{id}', 'PeopleController@show');
    $router->post('/people', 'PeopleController@store');
    $router->put('/people/{id}', 'PeopleController@update');
    $router->delete('/people/{id}', 'PeopleController@destroy');
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/contacts', 'ContactController@index');
    $router->get('/contacts/{id}', 'ContactController@show');
    $router->post('/contacts', 'ContactController@store');
    $router->put('/contacts/{id}', 'ContactController@update');
    $router->delete('/contacts/{id}', 'ContactController@destroy');
});
