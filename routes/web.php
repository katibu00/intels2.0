<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntelliSAS\SchoolController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\Settings\AssignSubjectsController;
use App\Http\Controllers\Settings\BasicSettingsController;
use App\Http\Controllers\Settings\CASchemeController;
use App\Http\Controllers\Settings\ClassesController;
use App\Http\Controllers\Settings\SectionsController;
use App\Http\Controllers\Settings\SessionsController;
use App\Http\Controllers\Settings\SubjectsController;
use App\Http\Controllers\Users\StudentsController;
use App\Jobs\ReetSchoolAdminPasswordJob;
use App\Mail\ResetSchoolAdminPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home.admin');
})->name('home');

Route::get('/sendmail', function () {

 
    Mail::to('admin@demoschool.com')->send(new ResetSchoolAdminPassword());

    return 'sendd successfully';
});

Route::middleware('tenant')->group(function() {
    // routes
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');


///// Intellisas routes /////
// Route::middleware('tenant')->group(function () {

    Route::group(['middleware' => ['auth', 'intellisas']], function () {
        Route::get('/intellisas/home', [HomeController::class, 'intellisas'])->name('intellisas.home');
    });
    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::get('/admin/home', [HomeController::class, 'admin'])->name('admin.home');
    });

    Route::group(['prefix' => 'schools', 'middleware' => ['auth', 'intellisas']], function () {
        Route::get('/index', [SchoolController::class, 'index'])->name('schools.index');
        Route::get('/admin/register', [SchoolController::class, 'adminCreate'])->name('school.admin.create');
        Route::post('/admin/register', [SchoolController::class, 'adminStore']);
        Route::post('/update/{id}', [SchoolController::class, 'update'])->name('school.admin.update');
        Route::post('/service/{id}', [SchoolController::class, 'service'])->name('service.record');
        Route::get('/logs/index', [SchoolController::class, 'log_index'])->name('logs.index');

        Route::post('/get-school-details', [SchoolController::class, 'getScholDetails'])->name('get-school-details');
    });

    Route::group(['prefix' => 'settings', 'middleware' => ['auth', 'admin']], function () {
        Route::get('/basic/index', [BasicSettingsController::class, 'index'])->name('settings.basic.index');
        Route::post('/basic/index', [BasicSettingsController::class, 'updateBasic']);


        Route::get('/sessions/index', [SessionsController::class, 'index'])->name('settings.sessions.index');
        Route::post('/sessions/index', [SessionsController::class, 'store']);
        Route::post('/sessions/delete', [SessionsController::class, 'delete'])->name('settings.session.delete');
        Route::post('/sessions/update', [SessionsController::class, 'update'])->name('settings.session.update');

        Route::get('/classes/index', [ClassesController::class, 'index'])->name('settings.classes.index');
        Route::post('/classes/index', [ClassesController::class, 'store']);
        Route::post('/classes/update', [ClassesController::class, 'update'])->name('settings.class.update');
        Route::post('/classes/delete', [ClassesController::class, 'delete'])->name('settings.class.delete');


        Route::get('/sections/index', [SectionsController::class, 'index'])->name('settings.sections.index');
        Route::post('/sections/index', [SectionsController::class, 'store']);
        Route::post('/sections/update', [SectionsController::class, 'update'])->name('settings.section.update');
        Route::post('/sections/delete', [SectionsController::class, 'delete'])->name('settings.section.delete');

        Route::get('/subjects/index', [SubjectsController::class, 'index'])->name('settings.subjects.index');
        Route::post('/subjects/index', [SubjectsController::class, 'store']);
        Route::post('/subjects/update', [SubjectsController::class, 'update'])->name('settings.subject.update');
        Route::post('/subjects/delete', [SubjectsController::class, 'delete'])->name('settings.subject.delete');

        Route::get('/assign_subjects/index', [AssignSubjectsController::class, 'index'])->name('settings.assign_subjects.index');
        Route::post('/assign_subjects/index', [AssignSubjectsController::class, 'store']);
        Route::post('/assign_subjects/update', [AssignSubjectsController::class, 'update'])->name('settings.assign_subjects.update');

        Route::get('/ca_scheme/index', [CASchemeController::class, 'index'])->name('settings.ca_scheme.index');
        Route::post('/ca_scheme/index', [CASchemeController::class, 'store']);
        Route::post('/ca_scheme/update', [CASchemeController::class, 'update'])->name('settings.ca_scheme.update');
        Route::post('/ca_scheme/delete', [CASchemeController::class, 'delete'])->name('settings.ca_scheme.delete');

    });


    Route::group(['prefix' => 'users', 'middleware' => ['auth','admin']], function(){

        Route::get('/students/index', [StudentsController::class, 'index'])->name('users.students.index');
        Route::get('/students/create', [StudentsController::class, 'create'])->name('users.students.create');
        Route::post('/students/store', [StudentsController::class, 'store'])->name('users.students.store');
        Route::post('/students/sort', [StudentsController::class, 'sort'])->name('users.students.sort');
        
        Route::post('/students/details', [StudentsController::class, 'details'])->name('users.students.details');
        
        Route::get('/students/bulk_update/index', [StudentsController::class, 'bulk_update'])->name('users.students.bulk_update.index');
        Route::post('/students/bulk_update/index', [StudentsController::class, 'bulk_update']);
        Route::post('/students/bulk_update/store', [StudentsController::class, 'bulk_store'])->name('users.students.bulk_update.store');
     
    });

    Route::group(['prefix' => 'marks', 'middleware' => ['auth', 'admin']], function(){
        Route::get('/create', [MarksController::class, 'create'])->name('marks.create');
        Route::post('/create',  [MarksController::class, 'getMarks']);
        Route::post('/initialize-marks-entry',  [MarksController::class, 'initializeMarks'])->name('initialize-marks-entry');
        Route::post('/save-marks-entry',  [MarksController::class, 'saveMarks'])->name('save-marks-entry');
        Route::post('/submit-marks-entry',  [MarksController::class, 'submitMarks'])->name('submit-marks-entry');
        Route::post('/check-absent-marks-entry',  [MarksController::class, 'checkAbsentMarks'])->name('check-absent-marks-entry');
        Route::post('/uncheck-absent-marks-entry',  [MarksController::class, 'uncheckAbsentMarks'])->name('uncheck-absent-marks-entry');
    
        Route::get('/submissions/index', [MarksController::class, 'submissionIndex'])->name('marks.submissions.index');
        Route::post('/submissions/index', [MarksController::class, 'submissionSearch']);


        Route::get('/grade_book/index', [MarksController::class, 'gradeBookIndex'])->name('marks.grade_book.index');
        Route::post('/grade_book/index', [MarksController::class, 'gradeGookSearch']);
    });

// });
