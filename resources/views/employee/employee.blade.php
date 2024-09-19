@extends('layouts.body_structer')

@section('content_header')
    الشئوون الادارية
@endsection

@section('content')

@php
    $is_there = false;
    $receipt_id = null;
    $receipt_ammount = 0;
@endphp


<div class="card">
    <div class="card-header">
        <h3 class="card-title">الموظفين</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
          <th>الاسم</th>
          <th>النوع</th>
          <th>القسم</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($employee as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->type }}</td>
                    <td>{{ $employee->section->name }}</td>
                    @if (auth()->user()->employee_salary_create)

                    @endif
                    <td>
                        @if (auth()->user()->employee_salary_create)
                            @foreach ($receipts as $receipt)
                                @if ($receipt->employee_id == $employee->id)
                                    @php
                                        $is_there = true;
                                        $receipt_id = $receipt->id;
                                        $receipt_ammount = $receipt->value;
                                    @endphp
                                @endif
                            @endforeach

                            @if ($is_there)
                                <form action="{{ route('employee.salary_update') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="number" min="0" name="ammount" value="{{ $receipt_ammount }}" class="w-25">
                                    <input type="text" name="receipt_id" value="{{ $receipt_id }}" hidden>
                                    <input type="submit" value="تعديل مرتب" class="btn btn-warning">
                                </form>
                            @else
                                <a href="{{ route('employee.salary_create', $employee->id) }}" class="btn btn-success">صرف مرتب</a>
                            @endif
                        @endif
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-info">تعديل</a>
                        <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-secondary">عرض</a>
                    </td>
                </tr>
                @php
                    $is_there = false;
                    $$receipt_id = null;
                    $receipt_ammount = 0;
                @endphp
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('costome_section_scripts')
    <script>
        $('button[type="submit"]').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل انت متأكد من أنك ترغب في حذف السجل ؟',
            text: 'لا يمكن التراجع عن حذف السجل',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم قم بالحذف',
            cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endsection

