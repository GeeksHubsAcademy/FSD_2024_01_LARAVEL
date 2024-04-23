<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return view('welcome');
});

// TASKS
Route::get('/tasks', [TaskController::class, 'getAllTasks']);
Route::post('/tasks', [TaskController::class, 'createTask']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTaskById']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTaskById']);
