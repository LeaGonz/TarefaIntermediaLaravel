<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrendasController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

// ruta com parametro
Route::get('/hello/{name}', function ($name) {
    return '<h1>Hello</h1>' . $name;
});


//****************************************** USERS ************************************ */
Route::get('/users', [UserController::class, 'userAll'])->name('users.show');
Route::get('/user/{id}', [userController::class, 'viewUser'])->name('users.view_user');
Route::get('/delete-user/{id}', [userController::class, 'deleteUser'])->name('users.delete_user');
Route::get('/add-users', [UserController::class, 'userAdd'])->name('users.add');
Route::post('/form-users', [userController::class, 'createUser'])->name('users.adicionar');

//****************************************** TAREFAS ************************************ */

Route::get('/tarefas', [TarefasController::class, 'showTarefas'])->name('tarefas.allTarefas');
Route::get('/tarefas-all', [TarefasController::class, 'showTarefas2'])->name('tarefas.allTarefas2');
Route::get('/tarefas/{id}', [TarefasController::class, 'viewTarefa'])->name('tasks.view_task');
Route::get('/delete-tarefa/{id}', [TarefasController::class, 'deleteTarefa'])->name('tasks.delete_task');
Route::post('/form-tasks', [TarefasController::class, 'createTask'])->name('tasks.adicionar');

//****************************************** PRENDAS ************************************ */

Route::get('/prendas-home', [PrendasController::class, 'prendasHome'])->name('prendas.home');
Route::get('/prendas-add', [PrendasController::class, 'prendasAdd'])->name('prendas.add');
Route::post('/prendas-form/show', [PrendasController::class, 'prendasAddFunction'])->name('prendas.addFunction');
Route::get('/prendas/show/{id}/{action}', [PrendasController::class, 'prendasShow'])->name('prendas.show');
Route::get('/prendas/delete{id}', [PrendasController::class, 'prendasDelete'])->name('prendas.delete');
Route::get('/prendas/update/{id}/{action}', [PrendasController::class, 'prendasShow'])->name('prendas.update');
Route::post('/prendas-form/update', [PrendasController::class, 'prendasUpdateFunction'])->name('prendas.updateFunction');







Route::fallback(function () {
    return view('fallback');
});
