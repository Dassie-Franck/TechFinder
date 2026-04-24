<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\CompetenceController;
use Termwind\Components\Raw;
use App\Http\Controllers\web\UtilisateurController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('web/competences')->name('web.competences.')->group(function () {
    Route::get('/',                 [CompetenceController::class, 'index'])->name('index');
    Route::get('/create',           [CompetenceController::class, 'create'])->name('create');
    Route::post('/',                [CompetenceController::class, 'store'])->name('store');
    Route::get('/{code_comp}',      [CompetenceController::class, 'show'])->name('show');
    Route::get('/{code_comp}/edit', [CompetenceController::class, 'edit'])->name('edit');
    Route::put('/{code_comp}',      [CompetenceController::class, 'update'])->name('update');
    Route::delete('/{code_comp}',   [CompetenceController::class, 'destroy'])->name('destroy');


});
Route::prefix('web/utilisateur')->name('web.utilisateur.')->group(function () {
    Route::get('/',                  [UtilisateurController::class, 'index'])->name('index');
    Route::get('/create',            [UtilisateurController::class, 'create'])->name('create');
    Route::post('/',                 [UtilisateurController::class, 'store'])->name('store');
    Route::get('/{code_user}',       [UtilisateurController::class, 'show'])->name('show');
    Route::get('/{code_user}/edit',  [UtilisateurController::class, 'edit'])->name('edit');
    Route::put('/{code_user}',       [UtilisateurController::class, 'update'])->name('update');
    Route::delete('/{code_user}',    [UtilisateurController::class, 'destroy'])->name('destroy');
});
