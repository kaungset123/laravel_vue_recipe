<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/recipes',[RecipeController::class, 'index']);

Route::get('/recipes/{recipe}',[RecipeController::class, 'show']);

Route::post('/recipes',[RecipeController::class, 'store']);

Route::put('/recipes/{recipe}',[RecipeController::class, 'update']);

Route::delete('/recipes/{recipe}',[RecipeController::class, 'destroy']);

Route::post('/recipes/upload',[RecipeController::class, 'upload']);

Route::get('/categories',[CategoryController::class, 'index']);

Route::post('/login',[AuthController::class, 'login']);

Route::get('/user',[AuthController::class, 'user'])->middleware('auth:sanctum');

Route::post('/register',[AuthController::class, 'register']);

Route::post('/forgot',[ForgotController::class, 'forgot']);

Route::post('/reset',[ForgotController::class, 'reset']);





