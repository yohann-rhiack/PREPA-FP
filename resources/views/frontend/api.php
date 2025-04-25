<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CycleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AttemptController;
use App\Http\Controllers\SubscriptionController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'user']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('cycles', CycleController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('chapters', ChapterController::class);
    Route::apiResource('summaries', SummaryController::class);
    Route::apiResource('types', TypeController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('tests', TestController::class);
    Route::apiResource('quizzes', QuizController::class);
    Route::apiResource('answers', AnswerController::class);
    Route::apiResource('plans', PlanController::class);
    Route::apiResource('attempts', AttemptController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
});
