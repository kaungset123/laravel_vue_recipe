<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/recipes',[RecipeController::class, 'index']);

Route::get('/recipes/{recipe}',[RecipeController::class, 'show']);

Route::post('/recipes',[RecipeController::class, 'store']);

Route::patch('/recipes/{recipe}',[RecipeController::class, 'update']);

Route::delete('/recipes/{recipe}',[RecipeController::class, 'destroy']);

Route::post('/recipes/upload',[RecipeController::class, 'upload']);

Route::get('/categories',[CategoryController::class, 'index']);



