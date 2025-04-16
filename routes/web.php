<?php

use App\Http\Controllers\AuthController;
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
use App\Http\Controllers\Frontend\RolesController;
use App\Http\Controllers\Frontend\TestsController;
use App\Http\Controllers\Frontend\TypesController;
use App\Http\Controllers\Frontend\UsersController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// Route::get('/Admin/Dashboard', [DashboardController::class, 'dashboard'])->name('frontend.admin-dashboard');


// // Middleware d'authentification pour la partie dashboard
Route::middleware(['auth'])->group(function () {

    
// Routes pour les écoles 
Route::get('/Admin/school', [SchoolsController::class, 'index'])->name('frontend.ecole');
Route::post('/schools/store', [SchoolsController::class, 'store'])->name('school.store');
Route::get('/schools/{id}/edit', [SchoolsController::class, 'edit'])->name('school.edit');
Route::put('/schools/{id}', [SchoolsController::class, 'update'])->name('school.update');
Route::delete('/schools/{id}', [SchoolsController::class, 'destroy'])->name('school.destroy');
Route::get('/frontend/schools/{id}/details', [SchoolsController::class, 'showSchoolDetails'])->name('school.details');


// Routes pour les cycles
Route::get('/Admin/cycle', [CyclesController::class, 'index'])->name('frontend.cycle');
Route::post('/cycles/store', [CyclesController::class, 'store'])->name('cycle.store');
Route::get('/cycles/{id}/edit', [CyclesController::class, 'edit'])->name('cycle.edit');
Route::put('/cycles/{id}', [CyclesController::class, 'update'])->name('cycle.update');
Route::delete('/cycles/{id}', [CyclesController::class, 'destroy'])->name('cycle.destroy');
Route::get('/cycles/{id}', [CyclesController::class, 'show'])->name('cycle.show');

// Routes pour les sujets
Route::get('/Admin/subject', [SubjectsController::class, 'index'])->name('frontend.subject');
Route::post('/subjects/store', [SubjectsController::class, 'store'])->name('subject.store');
Route::get('/subjects/{id}/edit', [SubjectsController::class, 'edit'])->name('subject.edit');
Route::post('/subjects/store', [SubjectsController::class, 'store'])->name('subject.store');
Route::get('/subjects/{id}/edit', [SubjectsController::class, 'edit'])->name('subject.edit');
Route::put('/subjects/{id}', [SubjectsController::class, 'update'])->name('subject.update');
Route::delete('/subjects/{id}', [SubjectsController::class, 'destroy'])->name('subject.destroy');
Route::get('/subjects/{id}', [SubjectsController::class, 'show'])->name('subject.show');

// Routes pour les cours
Route::get('/Admin/course', [CoursesController::class, 'index'])->name('frontend.cours');
Route::post('/courses/store', [CoursesController::class, 'store'])->name('course.store');
Route::get('/courses/{id}/edit', [CoursesController::class, 'edit'])->name('course.edit');
Route::put('/courses/{id}', [CoursesController::class, 'update'])->name('course.update');
Route::delete('/courses/{id}', [CoursesController::class, 'destroy'])->name('course.destroy');
Route::get('/courses/{id}', [CoursesController::class, 'show'])->name('course.show');

/// Routes pour les chapitres
Route::get('/Admin/chapitre', [ChaptersController::class, 'index'])->name('frontend.chapitre');
Route::post('/chapitres/store', [ChaptersController::class, 'store'])->name('chapitre.store');
Route::get('/chapitres/{id}/edit', [ChaptersController::class, 'edit'])->name('chapitre.edit');
Route::put('/chapitres/{id}', [ChaptersController::class, 'update'])->name('chapitre.update');
Route::delete('/chapitres/{id}', [ChaptersController::class, 'destroy'])->name('chapitre.destroy');
Route::get('/chapitres/{id}', [ChaptersController::class, 'show'])->name('chapitre.show');


// Routes pour les résumés
Route::get('/Admin/resume', [SummariesController::class, 'index'])->name('frontend.resume');
Route::post('/resumes/store', [SummariesController::class, 'store'])->name('resume.store');
Route::get('/resumes/{id}/edit', [SummariesController::class, 'edit'])->name('resume.edit');
Route::put('/resumes/{id}', [SummariesController::class, 'update'])->name('resume.update');
Route::delete('/resumes/{id}', [SummariesController::class, 'destroy'])->name('resume.destroy');
Route::get('/resumes/{id}', [SummariesController::class, 'show'])->name('resume.show');


/// Routes pour les tests
Route::get('/Admin/test', [TestsController::class, 'index'])->name('frontend.test');
Route::post('/tests/store', [TestsController::class, 'store'])->name('test.store');
Route::get('/tests/{id}/edit', [TestsController::class, 'edit'])->name('test.edit');
Route::put('/tests/{id}', [TestsController::class, 'update'])->name('test.update');
Route::delete('/tests/{id}', [TestsController::class, 'destroy'])->name('test.destroy');
Route::get('/tests/{id}', [TestsController::class, 'show'])->name('test.show');


// Routes pour les quiz
Route::get('/Admin/question', [QuizsController::class, 'index'])->name('frontend.question');
Route::post('/quizs/store', [QuizsController::class, 'store'])->name('quiz.store');
Route::get('/quizs/{id}/edit', [QuizsController::class, 'edit'])->name('quiz.edit');
Route::put('/quizs/{id}', [QuizsController::class, 'update'])->name('quiz.update');
Route::delete('/quizs/{id}', [QuizsController::class, 'destroy'])->name('quiz.destroy');
Route::get('/quizs/{id}', [QuizsController::class, 'show'])->name('quiz.show');


// Routes pour les réponses
Route::get('/Admin/reponse', [AnswersController::class, 'index'])->name('frontend.reponse');
Route::post('/answers/store', [AnswersController::class, 'store'])->name('answer.store');
Route::get('/answers/{id}/edit', [AnswersController::class, 'edit'])->name('answer.edit');
Route::put('/answers/{id}', [AnswersController::class, 'update'])->name('answer.update');
Route::delete('/answers/{id}', [AnswersController::class, 'destroy'])->name('answer.destroy');
Route::get('/answers/{id}', [AnswersController::class, 'show'])->name('answer.show');


// Routes pour les plans
Route::get('/Admin/plan', [PlansController::class, 'index'])->name('frontend.plan');
Route::post('/plans/store', [PlansController::class, 'store'])->name('plan.store');
Route::get('/plans/{id}/edit', [PlansController::class, 'edit'])->name('plan.edit');
Route::put('/plans/{id}', [PlansController::class, 'update'])->name('plan.update');
Route::delete('/plans/{id}', [PlansController::class, 'destroy'])->name('plan.destroy');
Route::get('/plans/{id}', [PlansController::class, 'show'])->name('plan.show');


// Routes pour les tentatives de tests
Route::get('/Admin/tentative', [AttemptsController::class, 'index'])->name('frontend.tentative');
Route::post('/tentatives/store', [AttemptsController::class, 'store'])->name('tentative.store');
Route::get('/tentatives/{id}/edit', [AttemptsController::class, 'edit'])->name('tentative.edit');
Route::put('/tentatives/{id}', [AttemptsController::class, 'update'])->name('tentative.update');
Route::delete('/tentatives/{id}', [AttemptsController::class, 'destroy'])->name('tentative.destroy');
Route::get('/tentatives/{id}', [AttemptsController::class, 'show'])->name('tentative.show');


/// Routes pour les abonnements
Route::get('/Admin/abonnement', [SubscriptionsController::class, 'index'])->name('frontend.abonnement');
Route::post('/abonnements/store', [SubscriptionsController::class, 'store'])->name('abonnement.store');
Route::get('/abonnements/{id}/edit', [SubscriptionsController::class, 'edit'])->name('abonnement.edit');
Route::put('/abonnements/{id}', [SubscriptionsController::class, 'update'])->name('abonnement.update');
Route::delete('/abonnements/{id}', [SubscriptionsController::class, 'destroy'])->name('abonnement.destroy');
Route::get('/frontend/abonnements/{id}/details', [SubscriptionsController::class, 'showAbonnementDetails'])->name('abonnement.details');


/// Routes pour les types
Route::get('/Admin/type', [TypesController::class, 'index'])->name('frontend.type');
Route::post('/type/store', [TypesController::class, 'store'])->name('type.store');
Route::get('/type/{id}/edit', [TypesController::class, 'edit'])->name('type.edit');
Route::put('/type/{id}', [TypesController::class, 'update'])->name('type.update');
Route::delete('/type/{id}', [TypesController::class, 'destroy'])->name('type.destroy');
Route::get('/type/{id}', [TypesController::class, 'show'])->name('type.show');

/// Routes pour les roles
Route::get('/Admin/role', [RolesController::class, 'index'])->name('frontend.role');
Route::post('/role/store', [RolesController::class, 'store'])->name('role.store');
Route::get('/role/{id}/edit', [RolesController::class, 'edit'])->name('role.edit');
Route::put('/role/{id}', [RolesController::class, 'update'])->name('role.update');
Route::delete('/role/{id}', [RolesController::class, 'destroy'])->name('role.destroy');
Route::get('/role/{id}', [RolesController::class, 'show'])->name('role.show');

// Routes pour les utilisateurs
Route::get('/Admin/utilisateur', [UsersController::class, 'index'])->name('frontend.utilisateur');
Route::post('/utilisateur/store', [UsersController::class, 'store'])->name('utilisateur.store');
Route::get('/utilisateur/{id}/edit', [UsersController::class, 'edit'])->name('utilisateur.edit');
Route::put('/utilisateur/{id}', [UsersController::class, 'update'])->name('utilisateur.update');
Route::delete('/utilisateur/{id}', [UsersController::class, 'destroy'])->name('utilisateur.destroy');
Route::get('/utilisateur/{id}', [UsersController::class, 'show'])->name('utilisateur.show');



    Route::get('/Admin/Dashboard', [DashboardController::class, 'dashboard'])->name('frontend.admin-dashboard');
  
});