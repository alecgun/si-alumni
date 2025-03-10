<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\KuliahController;
use Illuminate\Support\Facades\Route;



Route::get('/get-data-role', [RoleController::class, 'data'])->name('role.data');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('frontend.auth.login');
    });
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login-post', [AuthController::class, 'login'])->name('login.post');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //make route prefix setting
    Route::prefix('alumni')->group(function () {
        Route::resource('alumni', AlumniController::class);

        Route::get('/alumni/{alumnus}/kuliah', [KuliahController::class, 'index'])->name('kuliah.index');
        Route::get('/alumni/{alumnus}/kuliah/get-data', [KuliahController::class, 'getDataByAlumni'])->name('kuliah.data');
        Route::post('/alumni/{alumnus}/kuliah', [KuliahController::class, 'store'])->name('kuliah.store');
        Route::get('/alumni/{alumnus}/kuliah/{kuliah}/edit', [KuliahController::class, 'edit'])->name('kuliah.edit');
        Route::put('/alumni/{alumnus}/kuliah/{kuliah}', [KuliahController::class, 'update'])->name('kuliah.update');
        Route::delete('/alumni/{alumnus}/kuliah/{kuliah}', [KuliahController::class, 'destroy'])->name('kuliah.destroy');
    });

    Route::prefix('setting')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
    });


    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update-password', [ProfileController::class, 'update'])->name('profile.updatePassword');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
