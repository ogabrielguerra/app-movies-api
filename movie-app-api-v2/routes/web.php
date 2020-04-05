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
$router->get('/', ['uses' => 'AppController@home', 'as' => 'home']);
$router->get('/404', ['uses' => 'AppController@error404', 'as' => '404']);
$router->get('/build', ['uses' => 'CacheRunnerController@buildCache', 'as' => 'buildCache']);
$router->get('movies', ['uses' => 'MovieController@showAll', 'as' => 'movies']);
$router->get('movie/{id}', ['uses' => 'MovieController@showMovie', 'as' => 'showMovie']);
$router->get('genres', ['uses' => 'GenreController@showAll', 'as' => 'genres']);
$router->get('genres/names/{genresIdsList}', ['uses' => 'GenreController@getGenresNamesByIds', 'as' => 'genresNames']);
