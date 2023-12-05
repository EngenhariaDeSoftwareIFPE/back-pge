<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;

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

Route::put('/password-student/{student}', [StudentController::class, 'updatePassword']);

Route::apiResource('students', StudentController::class);

Route::post('/login-student', [AuthController::class, 'loginStudent']);
Route::post('/login-signatory', [AuthController::class, 'loginSignatory']);
