<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\CardHolderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Book routes
     */
    Route::resource("books",BookController::class);

    /**
     * User routes
     */
    Route::resource("users",CardHolderController::class);

    /**
     * BookIssue routes
     */

     Route::resource("book_issue", BookIssueController::class);

     Route::get('/book_issue/return/{id}', [BookIssueController::class, 'returnBook'])->name('book_issue.return');

     Route::post('/book_issue/return/{id}', [BookIssueController::class, 'issuedReturn'])->name('book_issue.issuedReturn');




});

require __DIR__.'/auth.php';
