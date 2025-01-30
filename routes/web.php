<?php

use App\Http\Controllers\RolesAndPermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Models\Form;

Route::get('/', function () {
    return view('rr');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('add-permission' ,[RolesAndPermissionController::class, 'addpermission']);



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('show-roles', [RolesAndPermissionController::class, 'show'])->name('show-roles');
    // Route::get('add-permission', [RolesAndPermissionController::class, 'addPermissions']);
    Route::get('create-roles', [RolesAndPermissionController::class, 'createRole']);
    Route::post('add-role', [RolesAndPermissionController::class, 'create']);
    Route::get('edit-role/{id}', [RolesAndPermissionController::class, 'editRole']);
    Route::post('update-role', [RolesAndPermissionController::class, 'updateRole']);
    Route::get('delete-role/{id}', [RolesAndPermissionController::class, 'delete']);
});

Route::middleware(['auth'])->group(function () {
    // Form Builder
    Route::get('/forms', [FormController::class, 'index'])->name('forms.index');
     Route::get('/forms/{form}/analytics', [FormController::class, 'analytics'])->name('forms.analytics');
});


Route::middleware(['auth','role:admin'])->group(function (){
   Route::get('/forms/create', [FormController::class, 'create'])->name('forms.create');
    Route::post('/forms', [FormController::class, 'store'])->name('forms.store');
    Route::put('/forms/{form}', [FormController::class, 'update'])->name('forms.update');
    Route::get('/forms/{form}/edit', [FormController::class, 'edit'])->name('forms.edit');
    Route::delete('/forms/{form}', [FormController::class, 'destroy'])->name('forms.destroy');
    // Route::get('/forms/{form}/qrcode', [FormController::class, 'qrcode'])->name('forms.qrcode');
    

});
Route::get('/forms/{form}/qrcode', [FormController::class, 'qrcode'])->name('forms.qrcode');
// Route::get('/forms/{form}/qrcode', [FormController::class, 'qrcode'])->name('forms.qrcode');
// Public Form Access
Route::get('/f/{form:slug}', [FormController::class, 'show'])->name('forms.show');
Route::post('/f/{form:slug}', [FormController::class, 'submit'])->name('forms.submit');
