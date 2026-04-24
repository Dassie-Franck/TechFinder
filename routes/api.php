<?php
Use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\competenceController;
Use App\Http\Controllers\InterventionController;
Use App\Http\Controllers\UserCompetenceController;
Use App\Http\Controllers\UtilisateurController;
// use App\Models\Intervention;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Here is where you can register API routes for your application. These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
*/

Route::apiResource('competences', competenceController::class);
Route::apiResource('interventions', InterventionController::class);
Route::apiResource('utilisateurs', UtilisateurController::class);
Route::apiResource('usercompetences', UserCompetenceController::class)->except(['show','update','destroy']);

Route::get('usercompetences/{code_user}/{code_comp}', [UserCompetenceController::class, 'show']);
Route::put('usercompetences/{code_user}/{code_comp}', [UserCompetenceController::class, 'update']);
Route::patch('usercompetences/{code_user}/{code_comp}', [UserCompetenceController::class, 'update']);
Route::delete('usercompetences/{code_user}/{code_comp}', [UserCompetenceController::class, 'destroy']);


Route::get('/competences/search', [competenceController::class, 'search']);
