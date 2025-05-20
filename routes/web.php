<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\KuliahController;
use App\Http\Controllers\KerjaController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostAcademicDataController;
use Illuminate\Support\Facades\Route;



Route::get('/get-data-role', [RoleController::class, 'data'])->name('role.data');
Route::get('/get-data-user', [UserController::class, 'data'])->name('user.data');
Route::get('/', [LandingController::class, 'index'])->name('landing.home');
Route::get('/data-alumni', [LandingController::class, 'dataAlumni'])->name('landing.dataAlumni');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', function () {
        return view('frontend.auth.login');
    });
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login-post', [AuthController::class, 'login'])->name('login.post');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/biodata', [LandingController::class, 'biodata'])->name('landing.biodata');
    Route::get('/get-alumni-by-user', [LandingController::class, 'getAlumniByAuthUser'])->name('landing.getAlumniByAuthUser');
    Route::post('biodata/change-password', [LandingController::class, 'updatePassword'])->name('landing.updatePassword');
    Route::get('biodata/{idAlumni}/edit', [LandingController::class, 'editSosmed'])->name('landing.editSosmed');
    Route::put('biodata/{idAlumni}', [LandingController::class, 'updateSosmed'])->name('landing.updateSosmed');
    Route::post('biodata/store-kuliah', [LandingController::class, 'storeKuliah'])->name('landing.storeKuliah');
    Route::get('biodata/{idAlumni}/edit-kuliah/{idKuliah}/edit', [LandingController::class, 'editKuliah'])->name('landing.editKuliah');
    Route::put('biodata/{idAlumni}/edit-kuliah/{idKuliah}', [LandingController::class, 'updateKuliah'])->name('landing.updateKuliah');
    Route::delete('biodata/{idAlumni}/delete-kuliah/{idKuliah}', [LandingController::class, 'deleteKuliah'])->name('landing.deleteKuliah');
    Route::post('biodata/store-kerja', [LandingController::class, 'storeKerja'])->name('landing.storeKerja');
    Route::get('biodata/{idAlumni}/edit-kerja/{idKerja}/edit', [LandingController::class, 'editKerja'])->name('landing.editKerja');
    Route::put('biodata/{idAlumni}/edit-kerja/{idKerja}', [LandingController::class, 'updateKerja'])->name('landing.updateKerja');
    Route::delete('biodata/{idAlumni}/delete-kerja/{idKerja}', [LandingController::class, 'deleteKerja'])->name('landing.deleteKerja');
    //make route prefix setting
    Route::prefix('alumni')->group(function () {
        Route::resource('alumni', AlumniController::class);
        Route::get('/alumni/{alumnus}/post-academic-data', [PostAcademicDataController::class, 'index'])->name('pad.index');
        Route::get('/alumni/{alumnus}/post-academic-data/kuliah', [PostAcademicDataController::class, 'kuliah'])->name('pad.kuliah');
        Route::get('/alumni/{alumnus}/post-academic-data/kerja', [PostAcademicDataController::class, 'kerja'])->name('pad.kerja');

        Route::get('/alumni/{alumnus}/kuliah/get-data', [KuliahController::class, 'getDataByAlumni'])->name('kuliah.data');
        Route::post('/alumni/{alumnus}/kuliah', [KuliahController::class, 'store'])->name('kuliah.store');
        Route::get('/alumni/{alumnus}/kuliah/{kuliah}/edit', [KuliahController::class, 'edit'])->name('kuliah.edit');
        Route::get('/alumni/{alumnus}/kuliah/{kuliah}/show', [KuliahController::class, 'show'])->name('kuliah.show');
        Route::put('/alumni/{alumnus}/kuliah/{kuliah}', [KuliahController::class, 'update'])->name('kuliah.update');
        Route::delete('/alumni/{alumnus}/kuliah/{kuliah}', [KuliahController::class, 'destroy'])->name('kuliah.destroy');

        Route::get('/alumni/{alumnus}/kerja/get-data', [KerjaController::class, 'getDataByAlumni'])->name('kerja.data');
        Route::post('/alumni/{alumnus}/kerja', [KerjaController::class, 'store'])->name('kerja.store');
        Route::get('/alumni/{alumnus}/kerja/{kerja}/edit', [KerjaController::class, 'edit'])->name('kerja.edit');
        Route::put('/alumni/{alumnus}/kerja/{kerja}', [KerjaController::class, 'update'])->name('kerja.update');
        Route::delete('/alumni/{alumnus}/kerja/{kerja}', [KerjaController::class, 'destroy'])->name('kerja.destroy');
    });

    Route::prefix('setting')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])->name('log.aktivitas.index');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update-password', [ProfileController::class, 'update'])->name('profile.updatePassword');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
