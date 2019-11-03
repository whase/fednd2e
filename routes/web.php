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
    return view('welcome');
});

Route::resource('characters', 'CharacterController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('characters/search', "CharacterController@search")->name('character.search');
Route::post('characters/fav/{character}', "CharacterController@switchFav")->name('character.fav');
Route::post('character/exp/{character}', "CharacterController@getExp")->name('character.getExp');
Route::post('character/lvlUp/{character}', "CharacterController@levelUp")->name('character.levelUp')->middleware('checkExp');
