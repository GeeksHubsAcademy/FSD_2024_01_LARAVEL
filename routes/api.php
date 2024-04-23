<?php

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

Route::get('/tasks', function () {
    return 'GET ALL TASKS';
});

Route::post('/tasks', function (Request $request) {
    dump($request->input('title'));

    $title = $request->input('title');

    return 'CREATE TASK';
});

Route::put('/tasks/{id}', function ($id) {
    return 'update TASK ' . $id;
});

Route::delete('/tasks/{id}', function ($id) {
    return 'delete TASK' . $id;
});
