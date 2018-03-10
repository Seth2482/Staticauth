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

Route::redirect('/', '/project');

Route::get('/project', 'ProjectController@index')->name('project.list');
Route::view('/project/create', 'project.create')->name('project.create');
Route::post('/project/site/{site?}', 'SiteController@store')->name('project.site.store');
Route::post('/project/{project?}', 'ProjectController@store')->name('project.store');
Route::get('/project/{project}/edit', 'ProjectController@edit')->name('project.edit');

Route::get('/project/{project}/site', 'ProjectController@show')->name('project.site.list');
Route::get('/project/{project}/site/create', 'ProjectController@createSite')->name('project.site.create');
Route::get('/project/{project}/site/{site}', 'ProjectController@editSite')->name('project.site.edit');
Route::post('/project/{project}/site/{site}/delete', 'SiteController@delete')->name('project.site.delete');


