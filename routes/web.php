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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-db', [TestController::class, 'testDB']);

// Libros
Route::resource('books', BookController::class);

Auth::routes();  // Esto genera las rutas de login, register, etc.

Route::get('register', [UserController::class, 'create'])->name('register');      // Mostrar formulario
Route::post('register', [UserController::class, 'store'])->name('register.store');


// Login
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/loginProces', [LoginController::class, 'loginProcess'])->name('login.process');

// Activación y espera
Route::get('/users/activate/account/{token}', [LoginController::class, 'validateAccount'])->name('activate.account');
Route::get('/usuarios/espera_confirmacion', fn() => view('usuarios.espera_confirmacion'))->name('usuarios.espera_confirmacion');

// Rutas protegidas
Route::middleware(['auth', 'account'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    
    // Perfil
    Route::resource('profile', ProfileController::class)->only(['show', 'edit', 'update']);

    // Usuarios
    Route::resource('usuarios', UserController::class)->except(['create']);

    // Posts
    Route::resource('posts', PostController::class);

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
