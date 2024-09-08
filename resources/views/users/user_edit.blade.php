@extends('layouts.body_structer')

@section('content_header')
    تعديل بيانات مستخدم
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">بيانات المستخدم</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
      <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>الاسم الرباعي</label>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="name" type="text" class="form-control" value="{{ $user->name }}">
                  </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>اسم النظام</label>
                    @error('username')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="username" type="text" class="form-control" value="{{ $user->username }}">
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
                    <input name="phone" type="text" class="form-control" placeholder="09X-XXXXXXX" value="{{ $user->phone }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>الصلاحية</label>
                    @error('role')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select class="custom-select" name="role">
                      <option value="finance" {{ $user->role == 'finance' ? 'selected' : '' }}>الشؤون المالية</option>
                      <option value="student_admin" {{ $user->role == 'student_admin' ? 'selected' : '' }}>شؤون الطلبة</option>
                      <option class="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>مدير النظام</option>
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
                    <input name="password" type="password" class="form-control" value="{{ $user->password }}">
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
