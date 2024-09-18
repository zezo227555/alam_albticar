@extends('layouts.body_structer')

@section('content_header')
    التقارير
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">كشف الطلبة للفصل الدراسي {{ $season->name }} {{ $season->created_at->format('Y') }}</h3>
        @if (!isset($section))
            <h4>كافة الاقسام</h4>
        @else
            <h4>{{ $section->name }}</h4>
        @endif
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
          <th>تاريخ التسجيل</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->attendance_type }}</td>
                    <td>{{ $student->created_at->format('Y-m-d | h:m A') }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
