<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\DashboardController;
use App\Http\Controllers\frontend\SchoolController;
use App\Http\Controllers\frontend\CycleController;
use App\Http\Controllers\frontend\SubjectController;
use App\Http\Controllers\frontend\CourseController;
use App\Http\Controllers\frontend\ChapterController;
use App\Http\Controllers\frontend\SummaryController;
use App\Http\Controllers\frontend\TestController;
use App\Http\Controllers\frontend\QuizController;
use App\Http\Controllers\frontend\AnswerController;
use App\Http\Controllers\frontend\PlanController;
use App\Http\Controllers\frontend\AttemptController;
use App\Http\Controllers\frontend\SubscriptionController;

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

Route::get('/Admin/Dashboard', [DashboardController::class, 'dashboard'])->name('frontend.admin-dashboard');

// Routes pour les écoles
Route::resource('schools', SchoolController::class);

// Routes pour les cycles
Route::resource('cycles', CycleController::class);

// Routes pour les sujets
Route::resource('subjects', SubjectController::class);

// Routes pour les cours
Route::resource('courses', CourseController::class);

// Routes pour les chapitres
Route::resource('chapters', ChapterController::class);

// Routes pour les résumés
Route::resource('summaries', SummaryController::class);

// Routes pour les tests
Route::resource('tests', TestController::class);

// Routes pour les quiz
Route::resource('quizzes', QuizController::class);

// Routes pour les réponses
Route::resource('answers', AnswerController::class);

// Routes pour les plans
Route::resource('plans', PlanController::class);

// Routes pour les tentatives de tests
Route::resource('attempts', AttemptController::class);

// Routes pour les abonnements
Route::resource('subscriptions', SubscriptionController::class);

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
