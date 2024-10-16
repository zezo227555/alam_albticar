@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">قائمة الطلبة بقسم <b>{{ $section->name }} ({{ $section->level }})</b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
          <th>رقم القيد</th>
          <th>الاسم</th>
          <th>رقم الهاتف</th>
          <th>الفصل الدراسي</th>
          <th>صفة القيد</th>
          <th>الحالة</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->st_id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->attendance_type }}</td>
                    <td>
                        @if ($student->graduated == 1)
                            خريج
                        @else
                            مستمر
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('student.grade_equation') }}" method="GET">
                            @csrf
                            <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                            <input type="text" name="section_id" value="{{ $section->id }}" hidden>
                            <button role="submit" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
