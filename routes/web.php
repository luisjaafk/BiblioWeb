<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LoanController;

Route::get('/', function () {
    return view('welcome');
});

// Ruta para probar conexión a la base de datos
Route::get('/test-db', [TestController::class, 'testDB']);

// Rutas de autenticación generadas por Laravel
//Auth::routes();

// Registro de usuarios personalizado
Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('register.store');

// Login personalizado
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginProces', [LoginController::class, 'loginProcess'])->name('login.process');

// Activación de cuenta por token
Route::get('/users/activate/account/{token}', [LoginController::class, 'validateAccount'])->name('activate.account');

// Vista para usuarios que esperan confirmación
Route::get('/usuarios/espera_confirmacion', fn () => view('usuarios.espera_confirmacion'))->name('usuarios.espera_confirmacion');

// Rutas protegidas por autenticación y verificación de cuenta
Route::middleware(['auth', 'validate.account'])->group(function () {

    // Dashboard
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    // Libros
    Route::resource('books', BookController::class);
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::get('/books/search', [BookController::class, 'searchFromAPI']);

    // Préstamos
    Route::resource('loans', LoanController::class);
    Route::post('loans', [LoanController::class, 'store'])->name('loans.store');

    Route::post('loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');
    Route::get('/loans/export/pdf', [LoanController::class, 'exportPdf'])->name('loans.export.pdf');

    

    // Perfil
    Route::resource('profile', ProfileController::class)->only(['show', 'edit', 'update']);

    // Usuarios (excepto create porque ya está arriba)
    Route::resource('usuarios', UserController::class)->except(['create']);

    // Posts o publicaciones
    Route::resource('posts', PostController::class);

    // Cierre de sesión
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
