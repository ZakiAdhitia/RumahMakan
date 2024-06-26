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

    $router->post('/store', 'ProductController@store');
    $router->patch('/update/{id}', 'ProductController@update');
    $router->delete('/delete/{id}', 'ProductController@destroy');

});


$router->group(['prefix' => 'transaction/'], function() use ($router) {

    $router->post('/store', 'TransactionController@store');
    $router->patch('/update/{id}', 'TransactionController@update');
    $router->delete('/delete/{id}', 'TransactionController@delete');

});


    
    


