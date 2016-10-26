<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();
Route::get('home', 'HomeController@index');
Route::get('/', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    // Proyectos
    Route::get('proyectos','ProjectController@index');
    Route::post('proyectos/registrar','ProjectController@create');
    Route::post('proyectos/editar','ProjectController@edit');
    Route::post('proyectos/eliminar','ProjectController@delete');
    Route::get('proyectos-niveles','ProjectController@level');
    Route::get('proyectos-estados','ProjectController@state');

    // Subproyectos
    Route::get('subproyectos/{id}','SubProjectController@index');
    Route::post('subproyectos/registrar','SubProjectController@create');
    Route::post('subproyectos/editar','SubProjectController@edit');
    Route::post('subproyectos/eliminar','SubProjectController@delete');

    // Incidencias
    Route::get('proyecto-incidencias','IncidentController@show');
    Route::get('incidencias/{id}','IncidentController@index');
    Route::post('incidencias/registrar','IncidentController@create');
    Route::post('incidencias/editar','IncidentController@edit');
    Route::post('incidencias/eliminar','IncidentController@delete');

    Route::get('incidencias-estados','IncidentController@state');
    Route::get('incidencias-frecuencias','IncidentController@frequency');
    Route::get('incidencias-prioridades','IncidentController@priority');

});
