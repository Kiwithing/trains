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

//Init load
$router->get('/', 'CSVController@index');

//Delete
$router->get('/remove/{id}', 'CSVController@deleteTrains');

//Upload / POST route
$router->post('/', 'CSVController@uploadCSV');

//Sort, ascending
$router->get('/sort/{sort_type}', 'CSVController@sortTrains');