<?php

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{etudiant}/show', [StudentController::class, 'show']);
Route::post('/students/add', [StudentController::class, 'addStudent']);
Route::post('/students/{etudiant}/update', [StudentController::class, 'update']);
Route::delete('/students/{etudiant}/delete', [StudentController::class, 'destroy']);
Route::get('/module/{module}/students', [StudentController::class, 'byModule']);

Route::get('/filieres/all', [App\Http\Controllers\FiliereController::class, 'index']);

Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/filieres/{filiere}/semestres/{semestre}/modules', [ModuleController::class, 'moduleByFiliereSemestre']);
Route::get('/filieres/{filiere}/modules', [ModuleController::class, 'moduleByFiliere']);
Route::get('/enseignants/{enseignant}/modules', [ModuleController::class, 'modulesEnseignant']);
Route::get('/etudiants/{etudiant}/modules', [ModuleController::class, 'modulesEtudiant']);

