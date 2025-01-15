@extends('layouts.body_structer')

@section('content_header')
    الطلبة
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <form action="{{ route('student.index') }}" method="GET">
                @csrf
                <div class="card card-primary">
                    <div class="card-header">بحث بالقسم الدراسي</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>القسم</label>
                            @error('section_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select name="section_id" class="mySelect form-control select2" style="width: 100%;">
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }} ({{ $section->level }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button role="submit" class="btn btn-primary w-50">بحث <i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <form action="{{ route('student.get_students_by_course') }}" method="GET">
                @csrf
                <div class="card card-primary">
                    <div class="card-header">بحث بالمادة</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>المادة</label>
                            @error('course_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select name="course_name" class="mySelect form-control select2" style="width: 100%;">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->name }}">{{ $course->name }} ({{ $course->section->name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button role="submit" class="btn btn-primary w-50">بحث <i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-6 mt-3">
            <form action="{{ route('student.get_students_by_level') }}" method="GET">
                @csrf
                <div class="card card-primary">
                    <div class="card-header">بحث بمستوى الطالب</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>نوع القسم</label>
                            @error('level')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select class="form-select" name="level">
                                <option value="متوسط" {{ $section->level == 'متوسط' ? 'selected' : '' }}>متوسط</option>
                                <option value="عالي" {{ $section->level == 'عالي' ? 'selected' : '' }}>عالي</option>
                                <option value="بكالوريس" {{ $section->level == 'بكالوريس' ? 'selected' : '' }}>بكالوريس
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button role="submit" class="btn btn-primary w-50">بحث <i
                                class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
