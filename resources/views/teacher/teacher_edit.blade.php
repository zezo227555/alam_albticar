@extends('layouts.body_structer')

@section('content_header')
    الشؤون الادارية
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">تعديل بيانات المدرس</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('teacher.update', $teacher->id) }}" method="POST">
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
                    <input name="name" type="text" class="form-control" value="{{ $teacher->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>المؤهل العلمي</label>
                    @error('section_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="degree" class="form-control" style="width: 100%;">
                        <option value="بكالوريس" @selected($teacher->name == 'بكالوريس')>بكالوريس</option>
                        <option value="ماجستير" @selected($teacher->name == 'ماجستير')>ماجستير</option>
                        <option value="دكتوراة" @selected($teacher->name == 'دكتوراة')>دكتوراة</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="phone" type="text" class="form-control" placeholder="09XXXXXXXX" value="{{ $teacher->phone }}">
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
