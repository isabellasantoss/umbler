<?php

use App\Http\Controllers\api\getCCTController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ChangePasswordController;;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController as Login;
use App\Http\Controllers\RegisterByStepsController as Register;
use App\Http\Controllers\ResetPassword;

use App\Http\Controllers\admin\empresas\logs\LogFuncionariosController;
use App\Http\Controllers\admin\empresas\CCTsController as CCT;
use App\Http\Controllers\admin\empresas\movimentacao\DependentesController as Dependentes;
use App\Http\Controllers\admin\empresas\movimentacao\FuncionariosController as Funcionarios;
use App\Http\Controllers\admin\empresas\CartoesControllers;
use App\Http\Controllers\admin\empresas\EmpresasController as Empresas;
use App\Http\Controllers\admin\relatorios\RelatoriosController;

use App\Http\Middleware\Funcionario\LogAcessar;
use App\Http\Middleware\Funcionario\LogCadastrar;
use App\Http\Middleware\Funcionario\LogEditar;
use App\Http\Middleware\Funcionario\LogExcluir;

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

Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('home');
Route::get('/relatorio', [RelatoriosController::class, 'index'])->middleware('auth')->name('relatorios.index');
Route::get('/logs-funcionarios', [LogFuncionariosController::class, 'index'])->middleware('auth')->name('log.funcionarios.index');

Route::controller(Login::class)->group(function () {
    Route::get('/entrar', 'index')->name('login');
    Route::get('/sair', 'logout')->name('logout');
    Route::post('/entrar/executar', 'login')->name('login.perform');
});

Route::controller(ResetPassword::class)->group(function () {
    Route::get('/redefinir-senha', 'show')->name('reset.password');
    Route::post('/redefinir-senha/executar', 'send')->name('reset.perform');
});

Route::controller(ChangePassword::class)->group(function () {
    Route::get('/change-password', 'show')->name('change-password');
    Route::post('/change-password/perform', 'update')->name('change.perform');
});

Route::controller(Register::class)->group(function () {
    Route::get('empresa/cadastrar-primeira-etapa', 'createStepOne')->name('enterprise.create.step.one');
    Route::post('empresa/cadastrar-primeira-etapa', 'postCreateStepOne')->name('enterprise.create.step.one.post');
    Route::get('empresa/cadastrar-segunda-etapa', 'createStepTwo')->name('enterprise.create.step.two');
    Route::post('empresa/cadastrar-segunda-etapa', 'postCreateStepTwo')->name('enterprise.create.step.two.post');
    Route::get('empresa/cadastrar-terceira', 'createStepThree')->name('enterprise.create.step.three');
    Route::post('empresa/cadastrar-terceira', 'postCreateStepThree')->name('enterprise.create.step.three.post');
});

Route::controller(ChangePasswordController::class)->group(function () {
    Route::get('/trocar-senha', 'trocarSenha')->middleware('auth')->name('senha');
    Route::post('/trocar-senha/perform', 'trocarSenhaperform')->middleware('auth')->name('senha.perform');
});

Route::controller(Funcionarios::class)->group(function () {
    Route::get('/funcionarios/index', 'index')->middleware('auth', LogAcessar::class)->name('funcionarios.index');
    Route::get('/funcionarios/cadastrar', 'create')->middleware('auth', LogCadastrar::class)->name('funcionarios.create');
    Route::get('/funcionarios/editar/{id}', 'edit')->middleware('auth', LogEditar::class)->name('funcionarios.edit');
    Route::delete('/funcionarios/excluir/{id}', 'destroy')->middleware('auth', LogExcluir::class)->name('funcionarios.destroy');
    Route::post('/funcionarios/inserir', 'store')->middleware('auth')->name('funcionarios.store');
    Route::get('/funcionarios/visualizar/{id}', 'show')->middleware('auth')->name('funcionarios.show');
    Route::put('/funcionarios/atualizar/{id}', 'update')->middleware('auth')->name('funcionarios.update');
    Route::get('funcionarios/export/', 'export')->middleware(['auth'])->name('funcionarios.export');
    Route::post('funcionarios/import', 'import')->middleware(['auth'])->name('funcionario.import');
});

Route::controller(Dependentes::class)->group(function () {
    Route::get('/dependentes/index', 'index')->middleware('auth')->name('dependentes.index');
    Route::get('/dependentes/cadastrar', 'create')->middleware('auth')->name('dependentes.create');
    Route::post('/dependentes/inserir', 'store')->middleware('auth')->name('dependentes.store');
    Route::get('/dependentes/editar/{id}', 'edit')->middleware('auth')->name('dependentes.edit');
    Route::get('/dependentes/visualizar/{id}', 'show')->middleware('auth')->name('dependentes.show');
    Route::put('/dependentes/atualizar/{id}', 'update')->middleware('auth')->name('dependentes.update');
    Route::delete('/dependentes/excluir/{id}', 'destroy')->middleware('auth')->name('dependentes.destroy');
    Route::get('dependentes/export/', 'export')->middleware(['auth'])->name('dependentes.export');
});

Route::controller(Empresas::class)->group(function () {
    Route::get('/empresas/dados-cadastrais/index', 'index')->middleware('auth')->name('empresas.index');
    Route::get('/empresas/dados-cadastrais/cadastrar', 'create')->middleware('auth')->name('empresas.create');
    Route::get('/empresas/dados-cadastrais/editar/{id}', 'edit')->middleware('auth')->name('empresas.edit');
    Route::get('/empresas/dados-cadastrais/visualizar/{id}', 'show')->middleware('auth')->name('empresas.show');
    Route::post('/empresas/dados-cadastrais/inserir', 'store')->middleware('auth')->name('empresas.store');
    Route::put('/empresas/dados-cadastrais/atualizar/{id}', 'update')->middleware('auth')->name('empresas.update');
    Route::delete('/empresas/dados-cadastrais/excluir/{id}', 'destroy')->middleware('auth')->name('empresas.destroy');
    Route::get('/empresas/contratos/index', 'contratosIndex')->middleware('auth')->name('contratos.index');
    Route::get('/empresas/contratos/cadastrar', 'contratosCreate')->middleware('auth')->name('contratos.create');
    Route::get('/empresas/contratos/editar/{id}', 'contratosEdit')->middleware('auth')->name('contratos.edit');
    Route::get('/empresas/contratos/visualizar/{id}', 'contratosShow')->middleware('auth')->name('contratos.show');
    Route::post('/empresas/contratos/inserir', 'contratosStore')->middleware('auth')->name('contratos.store');
    Route::put('/empresas/contratos/atualizar/{id}', 'contratosUpdate')->middleware('auth')->name('contratos.update');
    Route::delete('/empresas/contratos/excluir/{id}', 'contratosDelete')->middleware('auth')->name('contratos.destroy');
    Route::get('empresas/dados-cadastrais/export/', 'exportEmpresas')->middleware(['auth'])->name('empresas.export');
    Route::get('empresas/contratos/export/', 'exportContratos')->middleware(['auth'])->name('contratos.export'); 
});

Route::controller(CCT::class)->group(function () {
    Route::get('convencoes/index', 'index')->middleware('auth')->name('convencoes.index');
    Route::get('convencoes/cadastrar', 'create')->middleware('auth')->name('convencoes.create');
    Route::get('convencoes/editar/{id}', 'edit')->middleware('auth')->name('convencoes.edit');
    Route::get('convencoes/visualizar/{id}', 'show')->middleware('auth')->name('convencoes.show');
    Route::post('convencoes/inserir', 'store')->middleware('auth')->name('convencoes.store');
    Route::put('convencoes/atualizar/{id}', 'update')->middleware('auth')->name('convencoes.update');
    Route::delete('convencoes/excluir/{id}', 'destroy')->middleware('auth')->name('convencoes.destroy');
    Route::get('convencao/export/', 'export')->middleware(['auth'])->name('convencoes.export'); 
    Route::get('/buscar-cct/{id}', 'jsonCCT')->name('json.cct');
});

Route::controller(CartoesControllers::class)->group(function () {
    Route::get('cartoes/index', 'index')->middleware('auth')->name('cartoes.index');
    Route::get('cartoes/editar/{id}', 'edit')->middleware('auth')->name('cartoes.edit');
    Route::put('cartoes/atualizar/{id}', 'update')->middleware('auth')->name('cartoes.update');
    Route::get('cartoes/export/', 'export')->middleware(['auth'])->name('cartoes.export'); 
});