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
    function appinfo()
    {
        phpinfo();
//        $output = $router->app->version();

    }

    return appinfo();
});

$router->get('movies', ['uses' => 'MovieController@showAll', 'as' => 'movies']);
$router->get('movie/{id}', ['uses' => 'MovieController@showMovie', 'as' => 'showMovie']);
