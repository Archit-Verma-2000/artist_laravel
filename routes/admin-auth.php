<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\RegisterController;
    use App\Http\Controllers\Admin\LoginController;

    Route::prefix('admin')->group(function () {
        Route::get('/register', [RegisterController::class,'registerView'])->name('register');
        Route::post('/register', [RegisterController::class,'Register'])->name('registerstore');

        Route::get('/login', [LoginController::class,'loginView'])->name('login');
        Route::post('/login', [LoginController::class,'login'])->name('loginstore');

        Route::get('/dashboard',[LoginController::class,'dashboardView'])->name('dashboard');
        Route::get('/logout', [RegisterController::class,'logout'])->name('logout');
    });
?>