@extends('layouts.body_structer')

@section('content_header')
    اضافة مستخدم
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">بيانات المستخدم</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('users.store') }}" method="POST">
        @csrf
      <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>الاسم الرباعي</label>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>اسم النظام</label>
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="username" type="text" class="form-control" value="{{ old('username') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="phone" type="text" class="form-control" placeholder="09X-XXXXXXX" value="{{ old('phone') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>كلمة المرور</label>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="password" type="password" class="form-control">
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label>الصلاحيات</label>
                @error('role')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="form-group border rounded p-2">
                    <label>الاقسام الدراسية</label> <br>
                    <input type="checkbox" name="role[]" value="add_sections_courses" class="btn-check" id="btn-check-outlined1" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined1">اضافة الاقسام و المواد</label>
                    <hr>
                    <label>شؤون الطلبة</label> <br>
                    <input type="checkbox" name="role[]" value="add_students" class="btn-check" id="btn-check-outlined2" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined2">تسجيل الطلبة</label>
                    <input type="checkbox" name="role[]" value="stop_students" class="btn-check" id="btn-check-outlined3" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined3">ايقاف قيد الطلبة</label>
                    <input type="checkbox" name="role[]" value="student_marksheet_create" class="btn-check" id="btn-check-outlined4" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined4">رصد نتائج الطلبة</label>
                    <input type="checkbox" name="role[]" value="student_marksheet_see" class="btn-check" id="btn-check-outlined5" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined5">سحب كشوفات نتائج الطلبة</label>
                    <hr>
                    <label>الشؤون الادارية</label> <br>
                    <input type="checkbox" name="role[]" value="add_employee" class="btn-check" id="btn-check-outlined6" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined6">تسجيل موظف</label>
                    <input type="checkbox" name="role[]" value="employee_salary_create" class="btn-check" id="btn-check-outlined7" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined7">صرف مرتبات الموظفين</label>
                    <hr>
                    <label>الشؤون المالية</label> <br>
                    <input type="checkbox" name="role[]" value="treasury_main" class="btn-check" id="btn-check-outlined10" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined10">الشاشة الرئيسية</label>
                    <input type="checkbox" name="role[]" value="student_inroll" class="btn-check" id="btn-check-outlined11" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined11">تجديد قيد الطلبة</label>
                    <hr>
                    <label>تقارير</label> <br>
                    <input type="checkbox" name="role[]" value="new_students" class="btn-check" id="btn-check-outlined12" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined12">كشوفات الطلبة الجدد</label>
                    <input type="checkbox" name="role[]" value="student_inrollment" class="btn-check" id="btn-check-outlined13" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined13">كشوفات تجديد القيد</label>
                    <input type="checkbox" name="role[]" value="employee_salary_see" class="btn-check" id="btn-check-outlined14" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined14">كشوفات المرتبات</label>
                    <input type="checkbox" name="role[]" value="treasury_all_report" class="btn-check" id="btn-check-outlined15" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined15">كشف حساب الخزينة العام</label>
                    <hr>
                    <label>الاعدادات</label> <br>
                    <input type="checkbox" name="role[]" value="mark_sheet_hide" class="btn-check" id="btn-check-outlined16" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined16">حجب نتيجة الفصل الحالي</label>
                    <input type="checkbox" name="role[]" value="season_colse_open" class="btn-check" id="btn-check-outlined17" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btn-check-outlined17">انهاء و فتح الفصل الدراسي</label>
                </div>
            </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary w-25">حفظ</button>
      </div>
    </form>
  </div>

@endsection
