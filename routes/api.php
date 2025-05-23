<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use App\Models\Hackathon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    // Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Route::get('/role',[UserController::class ,'user'])->middleware('auth:api');
Route::get('/roles', [RoleController::class, 'showAllRoles'])->middleware('auth:api');
Route::post('/roles', [RoleController::class, 'create']);
Route::put('/roles/{id}', [RoleController::class, 'update'])->middleware('auth:api');
Route::delete('/roles/{id}', [RoleController::class, 'delete'])->middleware('auth:api');
Route::get('/myroles', [AuthController::class, 'hasRoles'])->middleware('auth:api');
Route::post('/hackathon', [HackathonController::class, 'create'])->middleware('auth:api');
Route::post('/team', [TeamController::class, 'create'])->middleware('auth:api');
Route::post('/jury/register',[JuryMemmberController::class , "create"]);
Route::get('rules', [RuleController::class , 'showAllRules'])->middleware('auth:api');
Route::post('rules', [RuleController::class , 'create'])->middleware('auth:api');
Route::put('rules/{id}', [RuleController::class , 'update'])->middleware('auth:api');
Route::delete('rules/{id}', [RuleController::class , 'delete'])->middleware('auth:api');
Route::post('themes', [ThemeController::class , 'create'])->middleware('auth:api');
Route::get('hackathons', [TeamController::class , 'view'])->middleware('auth:api');
Route::get('teams', [TeamController::class , 'show'])->middleware('auth:api');
Route::get('teams/{id}', [TeamController::class , 'search'])->middleware('auth:api');
Route::post('teams', [TeamController::class , 'create'])->middleware('auth:api');
Route::get('/hackathon/{id}', [HackathonController::class, 'search'])->middleware('auth:api');
Route::post('/participe', [TeamController::class, 'participe'])->middleware('auth:api');
Route::post('message', [TeamController::class , 'sendmesage'])->middleware('auth:api');
Route::post('Jury', [UserController::class , 'createJury'])->middleware('auth:api');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
