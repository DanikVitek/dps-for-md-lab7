<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

const SEE_OTHER = 303;

Route::redirect('/', 'todos', status: SEE_OTHER);
Route::resource('todos', TodoController::class);
