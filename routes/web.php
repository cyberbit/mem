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

$app->get('', ['as' => 'home', function() use ($app) {
    return $app->version();
}]);

$app->get('api', function() {
    return response()->json(['COW' => 'YES I AM REAL MAN YOU WANT TO GO SKATEBOARDS']);
});

$app->get('api/login', 'UserController@authenticate');

$app->group(['middleware' => 'auth'], function() use ($app) {
    // User routes
    $app->get('api/logout', 'UserController@logout');
    
    // Note routes
    $app->get('api/notes', 'NoteController@index');
    $app->get('api/notes/new', 'NoteController@create');
});