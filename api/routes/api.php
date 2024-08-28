<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomDamageController;
use App\Http\Controllers\RoomDeviceController;
use App\Http\Controllers\RoomGalleryController;
use App\Http\Controllers\RoomServiceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('rooms', RoomController::class);
Route::apiResource('floors', FloorController::class);
Route::apiResource('room-galleries', RoomGalleryController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('devices', DeviceController::class);
Route::apiResource('services', ServiceController ::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('payments', PaymentController::class);
Route::apiResource('order-items', OrderItemController::class);
Route::apiResource('room-services', RoomServiceController::class);
Route::apiResource('room-devices', RoomDeviceController::class);
Route::apiResource('vouchers', VoucherController::class);
Route::apiResource('damages', RoomDamageController::class);
