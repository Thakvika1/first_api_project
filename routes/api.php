<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\api\PermissionFeatureController;
use App\Http\Controllers\api\RolePermissionController;
use App\Http\Controllers\api\PermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // user
    Route::get('/user', [UserController::class, 'index'])->middleware('permission:user,list');
    Route::post('/user', [UserController::class, 'store'])->middleware('permission:user,create');
    Route::get('/user/{id}', [UserController::class, 'show'])->middleware('permission:user,edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->middleware('permission:user,edit');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('permission:user,delete');


    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

    // roles 
    Route::get('/role', [RoleController::class, 'index'])->middleware('permission:role,list');
    Route::post('/role', [RoleController::class, 'store'])->middleware('permission:role,create');
    Route::get('/role/{id}', [RoleController::class, 'show'])->middleware('permission:role,edit');
    Route::put('/role/{id}', [RoleController::class, 'update'])->middleware('permission:role,edit');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->middleware('permission:role,delete');

    // permissions 
    Route::get('/permission', [PermissionController::class, 'index']);
    Route::post('/permission', [PermissionController::class, 'store']);
    Route::get('/permission/{id}', [PermissionController::class, 'show']);
    Route::put('/permission/{id}', [PermissionController::class, 'update']);
    Route::delete('/permission/{id}', [PermissionController::class, 'destroy']);

    // permissions feature
    Route::get('/permission-feature', [PermissionFeatureController::class, 'index']);
    Route::post('/permission-feature', [PermissionFeatureController::class, 'store']);
    Route::get('/permission-feature/{id}', [PermissionFeatureController::class, 'show']);
    Route::put('/permission-feature/{id}', [PermissionFeatureController::class, 'update']);
    Route::delete('/permission-feature/{id}', [PermissionFeatureController::class, 'destroy']);

    // Role Permission
    Route::get('/role-permission/{role_id}', [RolePermissionController::class, 'index']);
    Route::post('/set-permission', [RolePermissionController::class, 'setPermission']);
});
