<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\CardHolderController;
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

    /**
     * Book routes
     */
    Route::get('/books', [BookController::class, 'index'])->name('get-books-api');

    
    /**
     * User routes
     */

    Route::get('/users', [CardHolderController::class, 'index'])->name('get-users-api');

    
    
    /**
     * Book Issue routes
     */

     Route::get('/book_issue', [BookIssueController::class, 'index'])->name('get-book_Issue-api');

    