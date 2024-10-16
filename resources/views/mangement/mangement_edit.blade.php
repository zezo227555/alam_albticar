@extends('layouts.body_structer')

@section('content_header')
    الاقسام الادارية
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
    <h3 class="card-title">تعديل بيانات القسم الاداري</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('mangement.update', $mangement->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>اسم القسم</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{ $mangement->name }}">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary w-25">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
        </div>
    </form>
</div>

@endsection
