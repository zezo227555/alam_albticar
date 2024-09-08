@extends('layouts.body_structer')

@section('content_header')
    الشئوون الادارية
@endsection

@section('content')


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
          <th>المرتب</th>
          <th>القسم</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($employee as $employee)
                <tr>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->type }}</td>
                    <td>{{ $employee->salary }}</td>
                    <td>{{ $employee->section->name }}</td>
                    <td>
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-info">تعديل</a>
                        <form action="{{ route('employee.destroy', $employee->id) }}" method="post" class="d-inline form_delete">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="حذف" class="btn btn-danger delete_button">
                        </form>
                    </td>
                </tr>
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

