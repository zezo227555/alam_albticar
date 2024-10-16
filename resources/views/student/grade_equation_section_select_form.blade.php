@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <form action="{{ route('student.grade_equation_form') }}" method="GET">
            @csrf
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">معادلة المواد للطلبة</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                    <label>القسم</label>
                    @error('section_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="section_id" class="mySelect form-control select2" style="width: 100%;">
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }} ({{ $section->level }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer text-center">
                <button role="submit" class="btn btn-primary w-50">بحث <i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection


