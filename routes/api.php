<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\api\PermissionFeatureController;
use App\Http\Controllers\api\RolePermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // user
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}', [UserController::class, 'get'])->name('user.show');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');

    // roles 
    Route::get('/role', [RoleController::class, 'index']);
    Route::post('/role', [RoleController::class, 'store']);
    Route::get('/role/{id}', [RoleController::class, 'show']);
    Route::put('/role/{id}', [RoleController::class, 'update']);
    Route::delete('/role/{id}', [RoleController::class, 'destroy']);

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

    Route::get('/test', function () {
        // return test();
        return "hello from route file";
    });
});
