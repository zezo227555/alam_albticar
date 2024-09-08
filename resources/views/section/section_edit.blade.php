@extends('layouts.body_structer')

@section('content_header')
    الاقسام الدراسية
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">تعديل بيانات القسم الدراسي</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('section.update', $section->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>اسم القسم</label>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{ $section->name }}">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>نوع القسم</label>
                        @error('level')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        <select class="custom-select" name="level">
                          <option value="متوسط" {{ $section->level == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                          <option value="عالي" {{ $section->level == 'عالي' ? 'selected' : '' }}>عالي</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary w-25">حفظ</button>
        </div>
    </form>
</div>

@endsection
