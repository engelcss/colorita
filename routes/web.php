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

$router->get('/[page/{page}]', 'MainController@index');
$router->post('/create', 'MainController@create');
$router->get('/generate/fucking/palettes/{please}', 'MainController@generateFuckingPalettes');

$router->get('/{url}', 'MainController@get');
