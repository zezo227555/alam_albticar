<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\MangementController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TreasuryController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsStudentLogged;
use App\Http\Middleware\IsUserLogedIn;
use App\Models\Mangement;
use Illuminate\Support\Facades\Route;

// الصلاحيات
Route::get("login", [AuthController::class, "loginForm"])->name('loginForm');
Route::post("loging", [AuthController::class,"login"])->name('loging');
Route::get("logout", [AuthController::class,"logout"])->name('logout');

Route::post("student_login", [AuthController::class,"student_login"])->name('student_login');
Route::get("student_login_form", [AuthController::class, "student_login_form"])->name('student_login_form');
Route::get("student_logout", [AuthController::class,"student_logout"])->name('student_logout');
Route::get('student_dashboard', [AuthController::class,'student_main'])->name('student_main')->middleware(IsStudentLogged::class);

Route::middleware(IsUserLogedIn::class)->group(function (){

    Route::get('dashboard', [AuthController::class,'main'])->name('main');

    // موارد النظام
    Route::resource('users', UserController::class);
    Route::resource('section', SectionController::class);
    Route::resource('treasury', TreasuryController::class);
    Route::resource('mangement', MangementController::class);
    Route::resource('teacher', TeacherController::class);

    // الاعدادات
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/season/new', [SettingsController::class, 'new_season_form'])->name('settings_new_season_form');
    Route::post('settings/season/close', [SettingsController::class, 'season_close'])->name('settings_season_close');
    Route::post('settings/season/new', [SettingsController::class, 'new_season'])->name('settings_season_new');
    Route::get('settings/haid_resault', [SettingsController::class, 'haid_resault'])->name('settings.haid_resault');
    Route::get('settings/see_resault', [SettingsController::class, 'see_resault'])->name('settings.see_resault');

    // الاقسام الدارسية
    Route::get('course/section/{section_id}', [CourseController::class,'index'])->name('course.index');
    Route::post('course/{section_id}', [CourseController::class,'store'])->name('course.store');
    Route::get('course/{course_id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('course/{course_id}', [CourseController::class,'update'])->name('course.update');
    Route::delete('course/{course_id}', [CourseController::class, 'destroy'])->name('course.destroy');

    // الدرجات
    Route::get('grade/student/{student_id}/', [GradeController::class, 'index'])->name('grade');
    Route::get('grade/create_grade_sheet', [GradeController::class, 'create_grade_sheet'])->name('grade.create_grade_sheet');
    Route::post('grade/update_grade_sheet', [GradeController::class, 'update_grade_sheet'])->name('grade.update_grade_sheet');
    Route::get('grade/old_grade_sheet', [GradeController::class, 'old_grade_sheet'])->name('grade.old_grade_sheet');
    Route::get('grade/old_grade_sheet_form', [GradeController::class, 'old_grade_sheet_form'])->name('grade.old_grade_sheet_form');
    Route::get('grade/old_grade_sheet/student/{student_id}/section/{section_id}/season/{season_id}', [GradeController::class, 'old_grade_sheet_search'])->name('grade.old_grade_sheet_search');
    Route::get('grade/old_grade_sheet_print/{student_id}/season/{season_id}', [GradeController::class, 'old_grade_sheet_print'])->name('grade.old_grade_sheet_print');

    // الخزينة و تجديد القيد
    Route::get('treasury/select/season_and_section', [TreasuryController::class, 'select_season_and_section'])->name('treasury.select_season_and_section');
    Route::get('treasury/season_and_section/student_enroll', [TreasuryController::class, 'student_enroll'])->name('treasury.student_enroll');
    Route::post('treasury/season_and_section/create_student_inroll', [TreasuryController::class, 'create_student_inroll'])->name('tresury.create_student_inroll');
    Route::post('treasury/season_and_section/update_student_inroll', [TreasuryController::class, 'update_student_inroll'])->name('tresury.update_student_inroll');
    Route::get('treasury/season_and_section/update_student_inroll_receipt', [TreasuryController::class, 'student_enroll_receipt'])->name('treasury.student_enroll_receipt');

    // شؤون الموظفين
    Route::resource('employee', EmployeeController::class);
    Route::get('employee/salary_create/{employee_id}', [EmployeeController::class, 'salary_create'])->name('employee.salary_create');
    Route::post('employee/salary_store', [EmployeeController::class, 'salary_store'])->name('employee.salary_store');
    Route::post('employee/salary_update', [EmployeeController::class, 'salary_update'])->name('employee.salary_update');

    // المدرسين
    Route::get('teacher/{teacher_id}/courses', [TeacherController::class, 'courses'])->name('teacher.courses');
    Route::post('teacher/courses/create', [TeacherController::class, 'teacherCoursesCreate'])->name('teacher.teacherCoursesCreate');
    Route::post('teacher/courses/destroy', [TeacherController::class, 'teacherCoursesDestroy'])->name('teacher.teacherCoursesDestroy');
    Route::get('teacher/{teacher_id}/salary', [TeacherController::class, 'teacherSalary'])->name('teacher.teacherSalary');
    Route::post('teacher/salary', [TeacherController::class, 'teacherSalaryCreate'])->name('teacher.teacherSalaryCreate');

    // التقارير
    Route::get('reports/students_inroll_form', [ReportController::class, 'students_inroll_form'])->name('reports.students_inroll_form');
    Route::get('reports/students_inroll', [ReportController::class, 'students_inroll'])->name('reports.students_inroll');
    Route::get('reports/student_payments_form', [ReportController::class, 'student_payments_form'])->name('reports.student_payments_form');
    Route::get('reports/student_payments', [ReportController::class, 'student_payments'])->name('reports.student_payments');
    Route::get('reports/season_resault_search/form', [ReportController::class, 'season_resault_search_form'])->name('reports.season_resault_search_form');
    Route::get('reports/season_resault_search', [ReportController::class, 'season_resault_search'])->name('reports.season_resault_search');
    Route::get('reports/employee_season_salary/form', [ReportController::class, 'employee_season_salary_form'])->name('reports.employee_season_salary_form');
    Route::get('reports/employee_season_salary', [ReportController::class, 'employee_season_salary'])->name('reports.employee_season_salary');
    Route::get('reports/account_statement/form', [ReportController::class, 'account_statement_form'])->name('reports.account_statement_form');
    Route::get('reports/account_statement', [ReportController::class, 'account_statement'])->name('reports.account_statement');

    // شؤون الطلبة
    Route::resource('student', StudentController::class);
    Route::post('student/deactivate_student', [StudentController::class, 'deactivate_student'])->name('student.deactivate_student');
    Route::post('student/deactivate_multiple_student', [StudentController::class, 'deactivate_multiple_student'])->name('student.deactivate_multiple_student');
    Route::post('student/activate_student', [StudentController::class, 'activate_student'])->name('student.activate_student');
    Route::get('student/{student_id}/student_full_marksheet', [StudentController::class, 'student_full_marksheet'])->name('student.student_full_marksheet');
    Route::get('student/grade_equation_section_select/form', [StudentController::class, 'grade_equation_section_select_form'])->name('student.grade_equation_section_select_form');
    Route::get('student/grade_equation/form', [StudentController::class, 'grade_equation_form'])->name('student.grade_equation_form');
    Route::get('student/grade/equation', [StudentController::class, 'grade_equation'])->name('student.grade_equation');
    Route::post('student/grade_equation_create', [StudentController::class, 'grade_equation_create'])->name('student.grade_equation_create');
    Route::get('student/graduated/students', [StudentController::class, 'graduated_students'])->name('student.graduated_students');
    Route::get('student/get_students/course', [StudentController::class, 'get_students_by_course'])->name('student.get_students_by_course');
    Route::get('student/get_students/level', [StudentController::class, 'get_students_by_level'])->name('student.get_students_by_level');
});

    Route::get('student/select_section/form', [StudentController::class, 'select_section'])->name('student.select_section');
    Route::get('student/get_student_season_resault/form', [StudentController::class, 'get_student_season_resault_form'])->name('student.get_student_season_resault_form');
    Route::get('student/get_student_season/resault', [StudentController::class, 'get_student_season_resault'])->name('student.get_student_season_resault');
