@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        @if (isset($section))
            <h3 class="card-title">قائمة الطلبة بقسم <b>{{ $section->name }} ({{ $section->level }})</b></h3>
        @else
            <h3 class="card-title">قائمة الخريجين</h3>
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
            <th>ر.م</th>
          <th>رقم القيد</th>
          <th>الاسم</th>
          <th>رقم الهاتف</th>
          <th>رقم ولي الامر</th>
          <th>الفصل الدراسي</th>
          <th>صفة القيد</th>
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
                    <td>{{ $student->st_id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->perant_phone }}</td>
                    <td>الفصل {{ $student->student_semester }}</td>
                    <td>{{ $student->attendance_type }}</td>
                    <td>
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                        <a href="{{ route('student.show', $student->id) }}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('student.student_full_marksheet', $student->id) }}" class="btn btn-info"><i class="fa-solid fa-book"></i></a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="post" class="d-inline form_delete">
                            @csrf
                            @method('DELETE')
                            <button role="submit" class="btn btn-danger delete_button"><i class="fa-solid fa-delete-left"></i></button>
                        </form>
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

@section('costome_section_scripts')
    <script>
        $('button[type="submit"]').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل انت متأكد من أنك ترغب في حذف المستخدم ؟',
            text: 'لا يمكن التراجع عن حذف المستخدم',
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

