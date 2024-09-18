@extends('layouts.student_body_structer')

@section('content_header')
    نتائج الفصل الدراسي
@endsection

@section('content')
    <form action="{{ route('student.get_student_season_resault') }}" method="GET">
        @csrf
        <div class="card card-primary">
            <div class="card-header">اختيار نتيجة الفصل الدراسي</div>
            <div class="card-body">
                <div class="form-group">
                    <label>الفصل الدراسي</label>
                    @error('season_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="season_id" class="mySelect form-control select2" style="width: 100%;">
                        @foreach ($seasons as $season)
                            <option value="{{ $season->id }}">{{ $season->name }} {{ $season->created_at->format('Y') }} {{ $season->active == 1 ? '(الفصل الحالي)' : '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <input type="text" name="student_id" value="{{ session('student')->id }}" hidden>
                <input type="submit" value="بحث" class="btn btn-primary w-25">
            </div>
        </div>
    </form>
@endsection
