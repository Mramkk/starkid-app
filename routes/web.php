<?php

use App\Http\Controllers\Admin\Exam\AdminExamController;
use App\Http\Controllers\Admin\Question\AdminQuestionController;
use App\Http\Controllers\Admin\Quset\AdminQusetController;
use App\Http\Controllers\Admin\Result\AdminResultController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\CalculationController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudExamAnsController;
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

Route::get('/', function () {
    return redirect(route('login'));
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/home', function () {
    return view('web.home');
})->middleware(['auth', 'verified'])->name('home');


// addition
Route::get('/addition', function () {
    return view('web.addition.index');
})->name('addition');
Route::get('/deciaml-addition', function () {
    return view('web.decimal-add.index');
})->name('deciaml-addition');
// add-sub
Route::get('/add-sub', function () {
    return view('web.addsub.index');
})->name('add-sub');
Route::get('/decimal-add-sub', function () {
    return view('web.decimaladdsub.index');
})->name('decimal-add-sub');
// multiply
Route::get('/multiply', function () {
    return view('web.multiply.index');
})->name('multiply');
Route::get('/decimal-multiply', function () {
    return view('web.decimal-multiply.index');
})->name('decimal-multiply');
// devision
Route::get('/division', function () {
    return view('web.division.index');
})->name('division');
// rnd num
Route::get('/random-number', function () {
    return view('web.random.index');
})->name('rnd-num');
// flash
Route::get('/flash', function () {
    return view('web.flash.index');
})->name('flash');
Route::get('/flash-setup', function () {
    return view('web.flash.setup');
})->name('flash-setup');

Route::get('/square-root', function () {
    return view('web.square.index');
})->name('square');
Route::get('/square-practice', function () {
    return view('web.square-practice.index');
})->name('square-practice');
Route::get('/cube-root', function () {
    return view('web.cube.index');
})->name('cube');
Route::get('/cube-practice', function () {
    return view('web.cube-practice.index');
})->name('cube-practice');
Route::get('/percentage', function () {
    return view('web.pecentage.index');
})->name('percentage');
Route::get('/times-table', function () {
    return view('web.times-table.index');
})->name('times-table');



Route::post('/multipliction', [CalculationController::class, 'multipliction'])->name('mul-submit');
Route::post('/division', [CalculationController::class, 'division'])->name('div-submit');
Route::post('/addition', [CalculationController::class, 'addition']);
Route::post('/subtraction', [CalculationController::class, 'subtraction']);
Route::post('/flash', [CalculationController::class, 'flashCard']);
Route::post('/square', [CalculationController::class, 'square']);
Route::post('/cube', [CalculationController::class, 'cube']);
Route::post('/student/ans', [StudExamAnsController::class, 'ansByStud']);
// exam
Route::get('/exam', [ExamController::class, 'index'])->name('exam');
Route::get('/exam/list/{slug}', [ExamController::class, 'list']);
Route::get('/exam/{id}', [ExamController::class, 'examById']);
// exam
Route::post('/result', [ResultController::class, 'store']);






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
        Route::post('/question/create', 'save');
        Route::post('/question/mcq', 'saveMcq')->name('admin.mcq.save');
        Route::get('quset/{qid}', 'edit');
        Route::post('quset/update', 'update');
    });
});

require __DIR__ . '/admin.php';
require __DIR__ . '/auth.php';
