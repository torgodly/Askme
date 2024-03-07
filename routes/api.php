<?php

use App\Http\Controllers\API\Auth\LoginController;
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

//Auth auth/token
Route::group(['middleware' => 'guest'], function () {
    Route::post('auth/token', LoginController::class);
});


//group middleware sanctum
Route::group(['middleware' => 'auth:sanctum'], function () {
    //get user
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    //send question
    Route::post('create/question', function (Request $request) {
        $request->validate([
            'body' => ['required']
        ]);
        $question = $request->user()->questions()->create($request->only('body'));
        return response()->json($question, 201);
    });


});
