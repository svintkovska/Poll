<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;
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

// 
Route::get('/test', [TestController::class, 'index'])->name('test.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/change-language/{language}', [LanguageController::class, 'changeLanguage']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('questions/store', [QuestionController::class, 'store'])->name('questions.store');
    Route::post('/question/{question}/update', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/question/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::get('/question/{question}/show', [QuestionController::class, 'show'])->name('questions.show');

});
Route::get('/', [PollController::class, 'index'])->name('poll.index');
Route::get('/poll/{question}/show', [PollController::class, 'show'])->name('poll.show');
Route::post('/poll/{question}/vote', [PollController::class, 'vote'])->name('poll.vote');



require __DIR__ . '/auth.php';
