@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">كشف درجات الطلبة للفصل الدراسي {{ $season->name }} {{ $season->created_at->format('Y') }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
          <th>الاسم</th>
          <th>رقم الهاتف</th>
          <th>القسم</th>
          <th>صفة القيد</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->attendance_type }}</td>
                    <td>
                        <a href="{{ route('grade.old_grade_sheet_search', [$student->id, $student->section->id, $season->id]) }}" class="btn btn-warning">كشف درجات الطالب</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
