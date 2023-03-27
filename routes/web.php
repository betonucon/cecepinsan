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


Route::group(['prefix' => 'warga','middleware'    => 'auth'],function(){
    Route::get('/','WargaController@index');
    Route::get('/get_data','WargaController@get_data');
    Route::get('/delete_data','WargaController@delete_data');
    Route::get('/generate_data','WargaController@generate_data');
    Route::get('/create','WargaController@create');
    Route::get('/tampil_dashboard','WargaController@tampil_dashboard');
    Route::post('/','WargaController@store');
    Route::post('/import','WargaController@import');
});
Route::group(['prefix' => 'pengumuman','middleware'    => 'auth'],function(){
    Route::get('/','PengumumanController@index');
    Route::get('/get_data','PengumumanController@get_data');
    Route::get('/delete_data','PengumumanController@delete_data');
    Route::get('/create','PengumumanController@create');
    Route::post('/','PengumumanController@store');
});
Route::group(['prefix' => 'pengaduan','middleware'    => 'auth'],function(){
    Route::get('/','PengaduanController@index');
    Route::get('/get_data','PengaduanController@get_data');
    Route::get('/view','PengaduanController@view');
    Route::get('/view_user','PengaduanController@view_user');
    Route::get('/terima','PengaduanController@terima');
    Route::get('/delete_data','PengaduanController@delete_data');
    Route::get('/create','PengaduanController@create');
    Route::post('/','PengaduanController@store');
    Route::post('/proses','PengaduanController@proses');
});
Route::group(['prefix' => 'pengaduanuser','middleware'    => 'auth'],function(){
    Route::get('/','PengaduanController@index_user');
    Route::get('/get_data','PengaduanController@get_data_user');
    
});
Route::group(['prefix' => 'pelayanan/{id}','middleware'    => 'auth'],function(){
    Route::get('/','PelayananController@index');
    Route::get('/get_data','PelayananController@get_data');
    Route::get('/cetak','PelayananController@cetak');
    Route::get('/terima','PelayananController@terima');
    Route::get('/delete_data','PelayananController@delete_data');
    Route::get('/create','PelayananController@create');
    Route::get('/view','PelayananController@view');
    Route::post('/','PelayananController@store');
    Route::post('/proses','PelayananController@proses');
});
Route::group(['prefix' => 'pelayananuser/{id?}','middleware'    => 'auth'],function(){
    Route::get('/','PelayananController@index_user');
    Route::get('/get_data','PelayananController@get_data_user');
    Route::get('/delete_data','PelayananController@delete_data_user');
    Route::get('/create','PelayananController@create_user');
    Route::get('/view','PelayananController@view_user');
    Route::post('/','PelayananController@store_user');
});
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
