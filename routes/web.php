<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/check', 'HomeController@check');
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/update', 'HomeController@update')->name('home.update')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('pegawai', 'PegawaiController', ['except' => ['show']]);
	Route::get('cuti-pegawai/info', 'CutiPegawaiController@index')->name('ajuancuti.index');
	Route::get('cuti-pegawai/input', 'CutiPegawaiController@create')->name('ajuancuti.create');
	Route::post('cuti-pegawai/proses', 'CutiPegawaiController@store')->name('ajuancuti.store');
	Route::get('cuti-pegawai/notif', 'CutiPegawaiController@notif')->name('ajuancuti.notif');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('kenaikan-gaji/info', 'KgbController@index')->name('kgb.index');
	Route::get('kenaikan-gaji/notif', 'KgbController@notif')->name('kgb.notif');
	Route::get('kenaikan-gaji/ajuan/{nip}', 'KgbController@ajuan')->name('kgb.ajuan');
	Route::get('kenaikan-gaji/detail/{nip}', 'KgbController@detail')->name('kgb.detail');
	Route::post('kenaikan-gaji/update', 'KgbController@update')->name('kgb.update');
	Route::get('kenaikan-gaji/verify/{nip}', 'KgbController@verify')->name('kgb.verify');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('kenaikan-pangkat/info', 'KppController@index')->name('kpp.index');
	Route::get('kenaikan-pangkat/notif', 'KppController@notif')->name('kpp.notif');
	Route::get('kenaikan-pangkat/ajuan/{nip}', 'KppController@ajuan')->name('kpp.ajuan');
	Route::get('kenaikan-pangkat/detail/{nip}', 'KppController@detail')->name('kpp.detail');
	Route::post('kenaikan-pangkat/update', 'KppController@update')->name('kpp.update');
	Route::get('kenaikan-pangkat/verify/{nip}', 'KppController@verify')->name('kpp.verify');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('waktu-pensiun/info', 'PensiunController@index')->name('pensiun.index');
	Route::get('waktu-pensiun/notif', 'PensiunController@notif')->name('pensiun.notif');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('pegawai', 'PegawaiController', ['except' => ['show']]);
	Route::get('db-pegawai/info', 'PegawaiController@index')->name('pegawai.index');
	Route::get('db-pegawai/detail/{nip}', 'PegawaiController@detail')->name('pegawai.detail');
	Route::get('db-pegawai/input', 'PegawaiController@create')->name('pegawai.create');
	Route::post('db-pegawai/proses', 'PegawaiController@store')->name('pegawai.store');
	Route::post('db-pegawai/edit/{nip}', 'PegawaiController@edit')->name('pegawai.edit');
	Route::get('db-pegawai/delete', 'PegawaiController@delete')->name('pegawai.delete');
	Route::post('db-pegawai/update', 'PegawaiController@update')->name('pegawai.update');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('pegawai', 'PegawaiController', ['except' => ['show']]);
	Route::get('arsip-pegawai/pensiun/info', 'ArsipController@indexp')->name('arsipp.index');
	Route::get('arsip-pegawai/pensiun/detail/{nip}', 'ArsipController@detailp')->name('arsipp.detail');
	Route::post('arsip-pegawai/pensiun/proses', 'ArsipController@storep')->name('arsipp.store');
	Route::get('arsip-pegawai/pensiun/edit/{nip}', 'ArsipController@editp')->name('arsipp.edit');
	Route::post('arsip-pegawai/pensiun/delete', 'ArsipController@deletep')->name('arsipp.delete');
	Route::get('arsip-pegawai/pensiun/notif', 'ArsipController@notifp')->name('arsipp.notif');

	Route::get('arsip-pegawai/mutasi/info', 'ArsipController@indexm')->name('arsipm.index');
	Route::get('arsip-pegawai/mutasi/detail/{nip}', 'ArsipController@detailm')->name('arsipm.detail');
	Route::post('arsip-pegawai/mutasi/proses', 'ArsipController@storem')->name('arsipm.store');
	Route::get('arsip-pegawai/mutasi/edit/{nip}', 'ArsipController@editm')->name('arsipm.edit');
	Route::post('arsip-pegawai/mutasi/delete', 'ArsipController@deletem')->name('arsipm.delete');
	Route::get('arsip-pegawai/mutasi/notif', 'ArsipController@notifm')->name('arsipm.notif');
});