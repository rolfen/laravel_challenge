<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\Author;
use App\Models\Library;
use App\Models\Book;

use App\Http\Controllers\AdminController;


Route::get('/', [AdminController::class, 'listBooks']);

Route::post('/edit/', [AdminController::class, 'editBook']);

Route::post('/edit/{id}', [AdminController::class, 'editBook']);

Route::get('/edit/{id}', [AdminController::class, 'editBook']);

Route::get('/edit/', [AdminController::class, 'editBook']);
