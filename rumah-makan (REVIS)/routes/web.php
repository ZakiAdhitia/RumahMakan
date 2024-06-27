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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'product/'], function() use ($router) {

    $router->post('/', 'ProductController@store');
    $router->patch('/{id}', 'ProductController@update');
    $router->delete('/{id}', 'ProductController@destroy');
    $router->get('/', 'ProductController@show');

});


$router->group(['prefix' => 'transaction/'], function() use ($router) {

    $router->post('/', 'TransactionController@store');
    $router->patch('/{id}', 'TransactionController@update');
    $router->delete('/{id}', 'TransactionController@destroy');
    $router->get('/', 'TransactionController@show');

});


    
    


