<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('posts', 'PostController');

//Route::get('posts/categoria/{categoriaId}', 'PostController@categoria');

Route::get('search', 'SearchController@search');

Route::resource('examenes', 'ExamenController');

//Route::get('examenes/categoria/{categoriaId}', 'ExamenController@categoria');

Route::resource('preguntas', 'PreguntaController', ['only' => ['store', 'update', 'destroy']]);

Route::group([
    'prefix'    =>  'admin',
    'namespace' =>  'Admin',
    'middleware' => 'auth'],
    function () {
        Route::get('/', 'AdminController@index');
        Route::resource('post', 'AdminPostController');
        Route::get('post/categoria/{categoria}', 'AdminPostController@categoria');        
        Route::resource('examen', 'AdminExamenController');
        Route::get('examen/categoria/{categoria}', 'AdminExamenController@categoria');
        Route::resource('pregunta', 'AdminPreguntaController', ['only' => ['store', 'update', 
            'destroy']]);
        Route::resource('categoria', 'AdminCategoriaController', ['except' => ['show']]);
    }
);

Auth::routes();