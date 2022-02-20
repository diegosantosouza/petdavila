<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonosController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\RegistrosController;
use App\Http\Controllers\ServiceController;
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
    Route::resource('tutores', 'DonosController');
    Route::post('tutores/search', [DonosController::class,'search'])->name('tutores.search');

    /**
     * Rotas para Animais
     */
    Route::resource('animais', 'AnimaisController');
    /**
     * Rotas para Registros
     */
    Route::get('registros/observacoes', [RegistrosController::class,'observacoes'])->name('registros.observacoes');
    Route::get('registros/relatorios', [RegistrosController::class,'relatorios'])->name('registros.relatorios');
    Route::post('registros/relatorios/gerar', [RegistrosController::class,'gerar'])->name('registros.gerar');
    Route::post('registros/relatorios/relatoriostutor', [RegistrosController::class,'relatoriosTutor'])->name('registros.relatoriosTutor');
    Route::resource('registros', 'RegistrosController');
    /**
     * Rotas para Financeiro
     */
    Route::post('financeiro/guardar', [FinanceController::class,'store'])->name('financeiro.store');
    Route::get('financeiro/mostar/{id}', [FinanceController::class,'show'])->name('financeiro.show');

    Route::get('finance/purchase', [FinanceController::class,'purchase'])->name('finance.purchase');
    Route::get('finance/recurrence', [FinanceController::class,'recurrence'])->name('finance.recurrence');
    // Route::get('finance/service', 'ServiceController@index')->name('service.index');
    Route::resource('finance', 'FinanceController');

    Route::post('service', [ServiceController::class,'store'])->name('service.store');
    Route::get('service', [ServiceController::class,'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class,'create'])->name('service.create');
    Route::post('service/search', [ServiceController::class,'search'])->name('service.search');
    Route::get('service/{service}', [ServiceController::class,'show'])->name('service.show');
    Route::put('service/{service}', [ServiceController::class,'update'])->name('service.update');
    Route::delete('service/{service}', [ServiceController::class,'destroy'])->name('service.destroy');
    Route::get('service/{service}/edit', [ServiceController::class,'edit'])->name('service.edit');

    /**
     * Purchases Routes
     */
    Route::post('purchases', [PurchasesController::class,'store'])->name('purchases.store');
    Route::get('purchases', [PurchasesController::class,'create'])->name('purchases.create');
    Route::put('purchases/{purchase}', [PurchasesController::class,'update'])->name('purchases.update');
    Route::delete('purchases/{purchase}', [PurchasesController::class,'destroy'])->name('purchases.destroy');
    Route::get('purchases/{purchase}/edit', [PurchasesController::class,'edit'])->name('purchases.edit');
});
