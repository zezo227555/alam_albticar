<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TreasuryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get("login", [AuthController::class, "loginForm"])->name('loginForm');
Route::post("loging", [AuthController::class,"login"])->name('loging');
Route::get("logout", [AuthController::class,"logout"])->name('logout');
Route::get('dashboard', [AuthController::class,'main'])->name('main');

Route::resource('users', UserController::class);
Route::resource('section', SectionController::class);
Route::resource('student', StudentController::class);
Route::resource('employee', EmployeeController::class);
Route::resource('treasury', TreasuryController::class);

// الاعدادات
Route::resource('settings', SettingsController::class);
Route::get('settings/season/new', [SettingsController::class, 'new_season_form'])->name('settings_new_season_form');
Route::post('settings/season/close', [SettingsController::class, 'season_close'])->name('settings_season_close');
Route::post('settings/season/new', [SettingsController::class, 'new_season'])->name('settings_season_new');

// الاقسام الدارسية
Route::get('course/section/{section_id}', [CourseController::class,'index'])->name('course.index');
Route::post('course/{section_id}', [CourseController::class,'store'])->name('course.store');
Route::get('course/{course_id}', [CourseController::class, 'edit'])->name('course.edit');
Route::put('course/{course_id}', [CourseController::class,'update'])->name('course.update');
Route::delete('course/{course_id}', [CourseController::class, 'destroy'])->name('course.destroy');

// الدرجات
Route::get('grade/student/{student_id}/', [GradeController::class, 'index'])->name('grade');
Route::get('grade/student/{student_id}/create_grade_sheet', [GradeController::class, 'create_grade_sheet'])->name('grade.create_grade_sheet');
Route::post('grade/update_grade_sheet', [GradeController::class, 'update_grade_sheet'])->name('grade.update_grade_sheet');
Route::get('grade/old_grade_sheet', [GradeController::class, 'old_grade_sheet'])->name('grade.old_grade_sheet');
Route::get('grade/old_grade_sheet_form', [GradeController::class, 'old_grade_sheet_form'])->name('grade.old_grade_sheet_form');
Route::get('grade/old_grade_sheet/student/{student_id}/section/{section_id}/season/{season_id}', [GradeController::class, 'old_grade_sheet_search'])->name('grade.old_grade_sheet_search');

// الخزينة و تجديد القيد
Route::get('treasury/select/season_and_section', [TreasuryController::class, 'select_season_and_section'])->name('treasury.select_season_and_section');
Route::get('treasury/season_and_section/student_enroll', [TreasuryController::class, 'student_enroll'])->name('treasury.student_enroll');
Route::post('treasury/season_and_section/create_student_inroll', [TreasuryController::class, 'create_student_inroll'])->name('tresury.create_student_inroll');
Route::post('treasury/season_and_section/update_student_inroll', [TreasuryController::class, 'update_student_inroll'])->name('tresury.update_student_inroll');
Route::get('treasury/season_and_section/update_student_inroll_receipt', [TreasuryController::class, 'student_enroll_receipt'])->name('treasury.student_enroll_receipt');
