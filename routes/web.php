<?php

use App\Http\Controllers\AnimaisController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonosController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\RecurrencesController;
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

Route::get('/', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('login/do', [AuthController::class, 'login'])->name('admin.login.do');
Route::group(['middleware' => ['auth']], function () {

    /** ADMIN */
    Route::group(['middleware' => 'admin'], function () {
        /** Purchases*/
        Route::put('purchases/{purchase}', [PurchasesController::class,'update'])->name('purchases.update');
        Route::delete('purchases/{purchase}', [PurchasesController::class,'destroy'])->name('purchases.destroy');
        Route::get('purchases/{purchase}/edit', [PurchasesController::class,'edit'])->name('purchases.edit');
        /** Tutors*/
        Route::delete('tutores/{tutore}', [DonosController::class, 'destroy'])->name('tutores.destroy');
        /** Animals*/
        Route::delete('animais/{animai}', [AnimaisController::class, 'destroy'])->name('animais.destroy');
        /** Finance*/
        Route::delete('finance/{finance}', [FinanceController::class, 'destroy'])->name('finance.destroy');
        /** Services*/
        Route::delete('service/{service}', [ServiceController::class,'destroy'])->name('service.destroy');
        /** Record*/
        Route::get('registros/{registro}/edit', [RegistrosController::class,'edit'])->name('registros.edit');


    });

    /**
     * dashboard
     */
    Route::get('admin', [AuthController::class, 'dashboard'])->name('admin');
    Route::get('admin/logout', [AuthController::class,'logout'])->name('admin.logout');
    Route::get('admin/mesesGet',  [AuthController::class,'chartmeses'])->name('admin.chartmeses');

    /**
     * User create edit delete
     */
//    Route::resource('admin/users', 'AdminUserController');

    /**
     * Rotas para Donos
     */
    Route::post('tutores', [DonosController::class, 'store'])->name('tutores.store');
    Route::get('tutores', [DonosController::class, 'index'])->name('tutores.index');
    Route::get('tutores/create', [DonosController::class, 'create'])->name('tutores.create');
    Route::get('tutores/{tutore}', [DonosController::class, 'show'])->name('tutores.show');
    Route::post('tutores/search', [DonosController::class, 'search'])->name('tutores.search');
    Route::put('tutores/{tutore}', [DonosController::class, 'update'])->name('tutores.update');
    Route::get('tutores/{tutore}/edit', [DonosController::class, 'edit'])->name('tutores.edit');

    /**
     * Rotas para Animais
     */
    Route::post('animais', [AnimaisController::class, 'store'])->name('animais.store');
    Route::get('animais', [AnimaisController::class, 'index'])->name('animais.index');
    Route::get('animais/create', [AnimaisController::class, 'create'])->name('animais.create');
    Route::get('animais/{animai}', [AnimaisController::class, 'show'])->name('animais.show');
    Route::put('animais/{animai}', [AnimaisController::class, 'update'])->name('animais.update');
    Route::get('animais/{animai}/edit', [AnimaisController::class, 'edit'])->name('animais.edit');
    /**
     * Rotas para Registros
     */
    Route::post('registros', [RegistrosController::class, 'store'])->name('registros.store');
    Route::get('registros', [RegistrosController::class, 'index'])->name('registros.index');
    Route::get('registros/create', [RegistrosController::class, 'create'])->name('registros.create');
    Route::get('registros/observacoes', [RegistrosController::class,'observacoes'])->name('registros.observacoes');
    Route::get('registros/relatorios', [RegistrosController::class,'relatorios'])->name('registros.relatorios');
    Route::get('registros/{registro}', [RegistrosController::class, 'show'])->name('registros.show');
    Route::put('registros/{registro}', [RegistrosController::class, 'update'])->name('registros.update');
    Route::delete('registros/{registro}', [RegistrosController::class,'destroy'])->name('registros.destroy');
    Route::post('registros/relatorios/gerar', [RegistrosController::class,'gerar'])->name('registros.gerar');
    Route::post('registros/relatorios/relatoriostutor', [RegistrosController::class,'relatoriosTutor'])->name('registros.relatoriosTutor');

    /**
     * Rotas para Financeiro
     */
    Route::post('financeiro/guardar', [FinanceiroController::class,'store'])->name('financeiro.store');
    Route::get('financeiro/mostar/{id}', [FinanceiroController::class,'show'])->name('financeiro.show');

    Route::post('finance', [FinanceController::class, 'store'])->name('finance.store');
    Route::get('finance', [FinanceController::class, 'index'])->name('finance.index');
    Route::get('finance/create', [FinanceController::class, 'create'])->name('finance.create');
    Route::get('finance/purchase', [FinanceController::class,'purchase'])->name('finance.purchase');
    Route::get('finance/recurrence', [FinanceController::class,'recurrence'])->name('finance.recurrence');
    Route::get('finance/{finance}', [FinanceController::class, 'show'])->name('finance.show');
    Route::put('finance/{finance}', [FinanceController::class, 'update'])->name('finance.update');
    Route::get('finance/{finance}/edit', [FinanceController::class, 'edit'])->name('finance.edit');

    /**
    * Rotas para serviços
     */
    Route::post('service', [ServiceController::class,'store'])->name('service.store');
    Route::get('service', [ServiceController::class,'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class,'create'])->name('service.create');
    Route::post('service/search', [ServiceController::class,'search'])->name('service.search');
    Route::get('service/{service}', [ServiceController::class,'show'])->name('service.show');
    Route::put('service/{service}', [ServiceController::class,'update'])->name('service.update');
    Route::get('service/{service}/edit', [ServiceController::class,'edit'])->name('service.edit');

    /**
     * Purchases Routes
     */
    Route::post('purchases', [PurchasesController::class,'store'])->name('purchases.store');
    Route::get('purchases', [PurchasesController::class,'create'])->name('purchases.create');

    /**
     * Recurrence Routes
     */
    Route::post('recurrence', [RecurrencesController::class,'store'])->name('recurrence.store');
    Route::get('recurrence', [RecurrencesController::class,'create'])->name('recurrence.create');

});
