<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\SchoolsController;
use App\Http\Controllers\Frontend\CyclesController;
use App\Http\Controllers\Frontend\SubjectsController;
use App\Http\Controllers\Frontend\CoursesController;
use App\Http\Controllers\Frontend\ChaptersController;
use App\Http\Controllers\Frontend\SummariesController;
use App\Http\Controllers\Frontend\SubscriptionsController;
use App\Http\Controllers\Frontend\AttemptsController;
use App\Http\Controllers\Frontend\PlansController;
use App\Http\Controllers\Frontend\AnswersController;
use App\Http\Controllers\Frontend\QuizsController;
use App\Http\Controllers\Frontend\TestsController;

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

Route::get('/Admin/Dashboard', [DashboardController::class, 'dashboard'])->name('frontend.admin-dashboard');

// Routes pour les écoles 
Route::get('/Admin/school', [SchoolsController::class, 'index'])->name('frontend.ecole');
Route::post('/schools/store', [SchoolsController::class, 'store'])->name('school.store');
Route::get('/schools/{id}/edit', [SchoolsController::class, 'edit'])->name('school.edit');
Route::put('/schools/{id}', [SchoolsController::class, 'update'])->name('school.update');
Route::delete('/schools/{id}', [SchoolsController::class, 'destroy'])->name('school.destroy');
Route::get('/schools/{id}', [SchoolsController::class, 'show'])->name('school.show');


// Routes pour les cycles
Route::get('/Admin/cycle', [CyclesController::class, 'index'])->name('frontend.cycle');


// Routes pour les sujets
Route::get('/Admin/subject', [SubjectsController::class, 'index'])->name('frontend.subject');

// Routes pour les cours
Route::get('/Admin/course', [CoursesController::class, 'index'])->name('frontend.cours');

// Routes pour les chapitres
Route::get('/Admin/chapitre', [ChaptersController::class, 'index'])->name('frontend.chapitre');

// Routes pour les résumés
Route::get('/Admin/resume', [SummariesController::class, 'index'])->name('frontend.resume');

// Routes pour les tests
Route::get('/Admin/test', [TestsController::class, 'index'])->name('frontend.test');

// Routes pour les quiz
Route::get('/Admin/question', [QuizsController::class, 'index'])->name('frontend.question');

// Routes pour les réponses
Route::get('/Admin/reponse', [AnswersController::class, 'index'])->name('frontend.reponse');

// Routes pour les plans
Route::get('/Admin/plan', [PlansController::class, 'index'])->name('frontend.plan');

// Routes pour les tentatives de tests
Route::get('/Admin/tentative', [AttemptsController::class, 'index'])->name('frontend.tentative');

// Routes pour les abonnements
Route::get('/Admin/abonnement', [SubscriptionsController::class, 'index'])->name('frontend.abonnement');

// Middleware d'authentification pour la partie dashboard
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
