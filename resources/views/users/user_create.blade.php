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
                    <label>الصلاحية</label>
                    @error('role')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select class="custom-select" name="role">
                      <option value="finance">الشؤون المالية</option>
                      <option value="student_admin">شؤون الطلبة</option>
                      <option class="admin">مدير النظام</option>
                    </select>
                  </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>كلمة المرور</label>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="password" type="password" class="form-control">
                  </div>
            </div>
            <div class="col-6"></div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary w-25">حفظ</button>
      </div>
    </form>
  </div>

@endsection
