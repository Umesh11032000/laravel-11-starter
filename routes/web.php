<?php

use App\Http\Controllers\ActivityLogsController;
use App\Http\Controllers\Admin\CheckEmailController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\Select2Controller;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard.index');
    } else if (Auth::guest()) {
        return redirect()->route('login');
    }
});

Route::get('/temp', function () {
    return view('admin.layouts.app');
});

Auth::routes();

// lang.swap
Route::get('lang/{locale}', [LanguageController::class, '__invoke'])->name('lang.swap');

Route::middleware(SetLocale::class)->group(function () {
    Route::prefix('admin/dashboard')->name('admin.dashboard.')->middleware('auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('/users-registrations', [DashboardController::class, 'userRegistrations'])->name('users-registrations');
    });
    
    Route::prefix('admin/users')->name('admin.users.')->middleware('auth')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('index')->can('view-all-users');
        Route::get('create', [UsersController::class, 'create'])->name('create')->can('create-update-user');
        Route::post('store', [UsersController::class, 'store'])->name('store');
        Route::post('check-email', [CheckEmailController::class, '__invoke'])->name('check-email');
        Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit')->can('create-update-user');
        Route::put('/{user}/update', [UsersController::class, 'update'])->name('update');
        Route::delete('/{user}/destroy', [UsersController::class, 'destroy'])->name('destroy')->can('delete-user');
    }); 

    Route::prefix('admin/select2')->name('admin.select2.')->middleware('auth')->group(function () {
        Route::post('/roles', [Select2Controller::class, 'roles'])->name('roles');
        Route::post('/states', [Select2Controller::class, 'states'])->name('states');
        Route::post('/cities', [Select2Controller::class, 'cities'])->name('cities');
    });

    Route::prefix('admin/roles')->name('admin.roles.')->middleware(['auth', 'role:Super Admin'])->group(function () {
        Route::get('/', [RolesController::class, 'index'])->name('index');
        Route::get('/create', [RolesController::class, 'create'])->name('create');
        Route::post('/store', [RolesController::class, 'store'])->name('store');
        Route::get('/{role}/edit', [RolesController::class, 'edit'])->name('edit');
        Route::put('/{role}/update', [RolesController::class, 'update'])->name('update');
        Route::delete('/{role}/destroy', [RolesController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('admin/activities')->name('admin.activities.')->middleware(['auth', 'role:Super Admin'])->group(function () {
        Route::get('/', [ActivityLogsController::class, 'index'])->name('index');
    });
});
