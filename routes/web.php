<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmpleadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', function () {
    // Muestra la vista de login
    return view('auth.login');
});

/*
Carga una vista
Route::get('/empleado', function () {
    return view('empleado.index');
});

 Con esta instrucción solo se puede acceder al método create
Route::get('empleado/create', [EmpleadoController::class, 'create']);
*/

// Con esta instrucción se puede acceder a todos los métodos de la clase EmpleadoController pero si se está autentificado: 
Route::resource('empleado',EmpleadoController::class)->middleware('auth'); // middleware('auth')->evita navegar por las url sin estar logeado

// Autentificación
// No se muestra ni la opción de registro ni recordar contraseña / register=registro y reset=recordar contraseña
Auth::routes(['register'=>false, 'reset'=>false]);

// Redirigir al index de EmpleadoController: 
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
            
});