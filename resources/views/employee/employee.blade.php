@extends('layouts.body_structer')

@section('content_header')
    الشئوون الادارية
@endsection

@section('content_action')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        اضافة موظف <i class="fa-solid fa-user-plus"></i>
    </button>
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
            <th>ر.م</th>
          <th>الاسم</th>
          <th>الهاتف</th>
          <th>القسم</th>
          @if (auth()->user()->employee_salary_create)
            <th>المرتب</th>
          @endif
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($employee as $employee)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->mangement->name }}</td>
                    @if (auth()->user()->employee_salary_create)
                    <td>
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
                            <input type="number" min="0" name="ammount" value="{{ $receipt_ammount }}" class="form-control d-inline w-50">
                            <input type="text" name="receipt_id" value="{{ $receipt_id }}" hidden>
                            <button role="submit" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></button>
                        </form>
                    @else
                        <a href="{{ route('employee.salary_create', $employee->id) }}" class="btn btn-success"><i class="fa-solid fa-money-bills"></i></a>
                    @endif
                    </td>
                @endif
                    <td>
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-info"><i class="fa-solid fa-user-pen"></i></a>
                        <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="post" class="d-inline form_delete">
                            @csrf
                            @method('DELETE')
                            <button role="submit" class="btn btn-danger delete_button"><i class="fa-solid fa-delete-left"></i></button>
                        </form>
                    </td>
                </tr>
                @php
                    $is_there = false;
                    $$receipt_id = null;
                    $receipt_ammount = 0;
                    $co++ ;
                @endphp
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection

@section('costome_section_scripts')
    <script>
        $('.delete_button').on('click', function(e) {
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

@section('section_modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">اضافة موظف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">بيانات الموظف</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('employee.store') }}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>الاسم الرباعي</label>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <label>المرتب</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" min="0" class="form-control" name="salary">
                                    <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>القسم الاداري</label>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <select name="mangement_id" class="form-control" style="width: 100%;">
                                        @foreach ($mangements as $mangement)
                                            <option value="{{ $mangement->id }}">{{ $mangement->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="phone" type="text" class="form-control" placeholder="09XXXXXXXX" value="{{ old('phone') }}">
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- /.card-body -->

                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary w-25">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
                      </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق <i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        </div>
    </div>
@endsection
