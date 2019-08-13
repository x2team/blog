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

Route::get('/', 'BlogController@index')->name('blog');

Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');

Route::get('/category/{category}', 'BlogController@category')->name('blog.category');

Route::get('/author/{author}', 'BlogController@author')->name('blog.author');

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

Route::put('/backend/blog/restore/{blog}', 'Backend\BlogController@restore')->name('backend.blog.restore');
Route::delete('/backend/blog/force-destroy/{blog}', 'Backend\BlogController@forceDestroy')->name('backend.blog.force-destroy');
Route::resource('/backend/blog', 'Backend\BlogController', ['as' => 'backend']);

Route::resource('/backend/categories', 'Backend\CategoriesController', ['as' => 'backend']);
Route::resource('/backend/user', 'Backend\UserController', ['as' => 'backend']);

Route::get('/backend/user/confirm/{user}', 'Backend\UserController@confirm')->name('backend.user.confirm');
