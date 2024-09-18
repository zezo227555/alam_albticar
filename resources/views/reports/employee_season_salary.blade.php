@extends('layouts.body_structer')

@section('content_header')
    التقارير
@endsection

@section('content')

@php
    $total = 0;
@endphp


<div class="card">
    <div class="card-header">
        <h3 class="card-title">تقارير المرتبات للموظفين</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
          <th>الاسم</th>
          <th>النوع</th>
          <th>القسم</th>
          <th>المرتب</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->type }}</td>
                    <td>{{ $employee->section->name }}</td>
                    <td>
                        @if ($employee->treasury->isEmpty())
                            <span class="btn btn-danger">لم يتم صرف مرتب</span>
                        @else
                            @foreach ($employee->treasury as $reicept)
                                {{ $reicept->value }}
                                @php
                                    $total += $reicept->value;
                                @endphp
                            @endforeach
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
