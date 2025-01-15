@extends('layouts.body_structer')

@section('content_header')
    التقارير
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        @if (!isset($season->name))
            <h5 class="card-title">كشف الطلبة لكافة الفصول الدراسية</h5>
        @else
            <h5 class="card-title">كشف الطلبة للفصل الدراسي {{ $season->name }} {{ $season->created_at->format('Y') }}</h5>
        @endif
        @if (!isset($section))
            <h5 class="card-title mx-1">(كافة الاقسام)</h5>
        @else
            <h5 class="card-title mx-1">({{ $section->name }})</h5>
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
            <th>ر.م</th>
          <th>الاسم</th>
          <th>الرقم الوطني</th>
          <th>الجنسية</th>
          <th>رقم الهاتف</th>
          <th>القسم</th>
          <th>صفة القيد</th>
          <th>تاريخ التسجيل</th>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($students as $student)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->nationla_id }}</td>
                    <td>{{ $student->nationality }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->attendance_type }}</td>
                    <td>{{ $student->created_at->format('Y-m-d | h:m A') }}</td>
                </tr>
                @php
                    $co ++;
                @endphp
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
