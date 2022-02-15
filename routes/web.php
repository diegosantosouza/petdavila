<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

/**
 * Rotas de cadastro
 */
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

/**
 * Login
 */



Route::get('/', 'AuthController@showLoginForm')->name('admin.login');
Route::post('login/do', 'AuthController@login')->name('admin.login.do');

Route::group(['middleware' => ['auth']], function () {
    /**
     * dashboard
     */
    Route::get('admin', 'AuthController@dashboard')->name('admin');

    Route::get('admin/logout', 'AuthController@logout')->name('admin.logout');

    Route::get('admin/mesesGet', 'AuthController@chartmeses')->name('admin.chartmeses');

    /**
     * User create edit delete
     */
//    Route::resource('admin/users', 'AdminUserController');

    /**
     * Rotas para Donos
     */
    Route::resource('tutores', 'DonosController');
    Route::post('tutores/search', 'DonosController@search')->name('tutores.search');

    /**
     * Rotas para Animais
     */
    Route::resource('animais', 'AnimaisController');
    /**
     * Rotas para Registros
     */
    Route::get('registros/observacoes', 'RegistrosController@observacoes')->name('registros.observacoes');
    Route::get('registros/relatorios', 'RegistrosController@relatorios')->name('registros.relatorios');
    Route::post('registros/relatorios/gerar', 'RegistrosController@gerar')->name('registros.gerar');
    Route::post('registros/relatorios/relatoriostutor', 'RegistrosController@relatoriosTutor')->name('registros.relatoriosTutor');
    Route::resource('registros', 'RegistrosController');
    /**
     * Rotas para Financeiro
     */
    Route::post('financeiro/guardar', 'FinanceiroController@store')->name('financeiro.store');
    Route::get('financeiro/mostar/{id}', 'FinanceiroController@show')->name('financeiro.show');

    Route::get('finance/purchase', 'FinanceController@purchase')->name('finance.purchase');
    Route::get('finance/recurrence', 'FinanceController@recurrence')->name('finance.recurrence');
    // Route::get('finance/service', 'ServiceController@index')->name('service.index');
    Route::resource('finance', 'FinanceController');

    Route::post('service', 'ServiceController@store')->name('service.store');
    Route::get('service', 'ServiceController@index')->name('service.index');
    Route::get('service/create', 'ServiceController@create')->name('service.create');
    Route::post('service/search', 'ServiceController@search')->name('service.search');
    Route::get('service/{service}', 'ServiceController@show')->name('service.show');
    Route::put('service/{service}', 'ServiceController@update')->name('service.update');
    Route::delete('service/{service}', 'ServiceController@destroy')->name('service.destroy');
    Route::get('service/{service}/edit', 'ServiceController@edit')->name('service.edit');

    /**
     * Purchases Routes
     */
    Route::post('purchases', 'PurchasesController@store')->name('purchases.store');
    Route::get('purchases', 'PurchasesController@create')->name('purchases.create');
});
