@extends('layouts.body_structer')

@section('content_header')
    مواد القسم
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">تعديل بيانات المادة</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">بيانات المادة</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" action="{{ route('course.update', $course->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>اسم المادة</label>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{ $course->name }}">
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="حفظ" class="btn btn-primary w-25">
                </div>
            </form>
        </div>
    </div>
  </div>

@endsection
