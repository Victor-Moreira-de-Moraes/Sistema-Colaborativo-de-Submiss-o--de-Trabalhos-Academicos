<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionVersionController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Rotas de autenticação
require __DIR__.'/auth.php';

// Dashboard agora chama o ProfileController@dashboard
Route::get('/dashboard', [ProfileController::class, 'dashboard'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // Equipes
    Route::resource('teams', TeamController::class);
    Route::post('teams/{team}/invite', [TeamController::class, 'invite'])
         ->name('teams.invite');

    // Submissões
    Route::resource('teams.submissions', SubmissionController::class);

    // Versionamento
    Route::resource('teams.submissions.versions', SubmissionVersionController::class)
         ->only(['create','store','show']);

    // Comentários
    Route::resource('teams.submissions.versions.comments', CommentController::class)
         ->only(['store']);
});
