<?php

use App\Http\Controllers\Admin\Exam\AdminExamController;
use App\Http\Controllers\Admin\Question\AdminQuestionController;
use App\Http\Controllers\Admin\Quset\AdminQusetController;
use App\Http\Controllers\Admin\Result\AdminResultController;
use App\Http\Controllers\Admin\User\UserController;

//

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest:admin')->prefix('admin')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('admin.register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('admin.login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('admin.password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('admin.password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('admin.password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('admin.password.store');
});

Route::middleware('auth:admin')->prefix('admin')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('admin.verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('admin.verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('admin.verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('admin.password.confirm');

    Route::post('admin.confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('admin.password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('admin.logout');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    // exam

    Route::get('/exam', [AdminExamController::class, 'index']);
    Route::get('/exam/create', [AdminExamController::class, 'createExamIndex'])->name('createExamIndex');
    Route::get('/exam/{slug}', [AdminExamController::class, 'exam']);
    Route::get('/exam/view/{id}', [AdminExamController::class, 'view']);
    Route::get('/exam/edit/{id}', [AdminExamController::class, 'edit']);
    Route::post('/exam/edit', [AdminExamController::class, 'update']);
    Route::post('/exam/delete', [AdminExamController::class, 'delete']);
    Route::post('/exam/create', [AdminExamController::class, 'createExam']);

    //  question
    Route::get('/question/{id}', [QuestionController::class, 'byExamId']);
    // user
    Route::get('student', [UserController::class, 'userList'])->name('admin.student');
    Route::get('student/{id}', [UserController::class, 'details']);
    Route::post('student/status', [UserController::class, 'status']);
    // class
    Route::get('/class', [UserController::class, 'classList']);

    // retult
    Route::get('/result', [AdminResultController::class, 'index'])->name('admin.result.index');
    Route::get('/result/{id}', [AdminResultController::class, 'exams']);
    Route::get('/result/{uid}/{exid}', [AdminResultController::class, 'result']);

    Route::controller(AdminQuestionController::class)->group(function () {
        Route::get('/exam/{exid}/question', 'index');
        Route::get('question/{exid}/{qid}', 'edit');
        Route::post('/question/create', 'save')->name('admin.question.save');
        Route::post('/question/update', 'update')->name('admin.question.update');
        Route::post('/question/mcq/save', 'saveMcq')->name('admin.mcq.save');
        Route::post('/question/mcq/update', 'updateMcq')->name('admin.mcq.update');

        // Route::post('quset/update', 'update');
    });
});
