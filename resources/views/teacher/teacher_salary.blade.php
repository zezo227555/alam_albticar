@extends('layouts.body_structer')

@section('content_header')
    الشئوون الادارية
@endsection

@section('content')

<form action="{{ route('teacher.teacherSalaryCreate') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">قائمة المواد للمدرس ({{ $teacher->name }})</h3>
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
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped text-center w-100" id="datatable">
            <thead>
            <tr>
                <th>ر.م</th>
              <th>المادة</th>
              <th>القسم</th>
              <th>تاريخ الاضافة</th>
              <th>عدد المحاضرات</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $co = 1;
                    $salary = 0;
                @endphp
                @foreach ($teacher_courses as $teacher_course)
                    <tr>
                        <td>{{ $co }}</td>
                        <td>{{ $teacher_course->course->name }}</td>
                        <td>{{ $teacher_course->section->name }} ({{ $teacher_course->section->level }})</td>
                        <td>{{ $teacher_course->created_at }}</td>
                        <td>
                            <input type="number" min="0" class="form-control w-25 d-inline" name="lecturs[{{ $teacher_course->id }}]">
                        </td>
                    </tr>
                    @php
                        $co++ ;
                    @endphp
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
            <input type="text" name="teacher_id" value="{{ $teacher->id }}" hidden>
            <button role="submit" class="btn btn-success w-25">صرف المرتب <i class="fa-solid fa-money-bills"></i></button>
        </div>
    </div>
</form>

@endsection
