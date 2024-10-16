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
            <th>ر.م</th>
          <th>الاسم</th>
          <th>رقم الهاتف</th>
          <th>القسم</th>
          <th>صفة القيد</th>
          <th>الفصل</th>
          <th>اجراء</th>
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
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>{{ $student->attendance_type }}</td>
                    <td>{{ $student->student_semester }}</td>
                    <td>
                        <a href="{{ route('grade.old_grade_sheet_search', [$student->id, $student->section->id, $season->id]) }}" class="btn btn-warning"><i class="fa-solid fa-address-book"></i></a>
                    </td>
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
