<?php
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Admin\RegisterController;
    use App\Http\Controllers\Admin\AdminController;

    Route::prefix('admin')->group(function () {
        Route::get('/register', [RegisterController::class,'registerView'])->name('admin.register');
        Route::post('/register', [RegisterController::class,'Register'])->name('admin.registerstore');

        Route::get('/login', [RegisterController::class,'loginView'])->name('admin.login');
        Route::post('/login', [RegisterController::class,'login'])->name('admin.loginstore');

        Route::get('/dashboard',[RegisterController::class,'dashboardView'])->name('admin.dashboard');
        Route::get('/logout', [RegisterController::class,'logout'])->name('admin.logout');
        
        Route::get('/dashboard/users',function(){
            return view('Admin.pages.Admin');
        })->name('admin.dashboard.users');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/register', [AdminController::class,'registerView'])->name('customer.register');
        Route::post('/register', [AdminController::class,'Register'])->name('customer.registerstore');

        Route::get('/login', [AdminController::class,'loginView'])->name('customer.login');
        Route::post('/login', [AdminController::class,'login'])->name('customer.loginstore');

        Route::get('/dashboard',[AdminController::class,'dashboardView'])->name('customer.dashboard');
        Route::get('/logout', [AdminController::class,'logout'])->name('customer.logout');
        
      
    });
?>