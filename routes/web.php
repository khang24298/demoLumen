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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('users', 'APIController@index');
    $router->get('user/{id}', 'APIController@show');
    $router->get('users/{id}', 'APIController@testRedis');
    $router->post('users', 'APIController@store');
});
$router->get('/home', function(){
    $redis = app()->make('redis');
    $redis->set("key1","value1");
    print_r($redis->get("key1"));
});
