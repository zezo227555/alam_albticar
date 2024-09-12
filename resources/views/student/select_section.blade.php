@extends('layouts.body_structer')

@section('content_header')
    الطلبة
@endsection

@section('content')
    <form action="{{ route('student.index') }}" method="GET">
        @csrf
        <div class="card card-primary w-50">
            <div class="card-header">اختيار القسم الدراسي</div>
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
            <div class="card-footer">
                <input type="submit" value="بحث" class="btn btn-primary w-50">
            </div>
        </div>
    </form>
@endsection
