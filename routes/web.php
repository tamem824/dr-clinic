<?php

use App\Http\Controllers\EndoscopyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;

use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\DiagnosisController;
use App\Http\Controllers\Auth\ChangePasswordController;


Route::redirect('/', '/login');

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

// Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

// Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

// Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

// Patient

    Route::delete('patients/destroy', [PatientController::class, 'massDestroy'])->name('patients.massDestroy');
    Route::post('patients/media', [PatientController::class, 'storeMedia'])->name('patients.storeMedia');
    Route::post('patients/ckmedia', [PatientController::class, 'storeCKEditorImages'])->name('patients.storeCKEditorImages');
    Route::resource('patients', PatientController::class);



// Diagnosis
    Route::delete('diagnoses/destroy', [DiagnosisController::class, 'massDestroy'])->name('diagnoses.massDestroy');

    Route::resource('diagnoses', DiagnosisController::class);


// Endoscopies
    Route::get('endoscopies/{id}/info', [EndoscopyController::class, 'info'])->name('patients.info');
    Route::resource('endoscopies', EndoscopyController::class);
    Route::delete('endoscopies/destroy', [EndoscopyController::class, 'massDestroy'])->name('endoscopies.massDestroy');


});

Route::middleware(['auth'])->prefix('profile')->as('profile.')->group(function () {
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
