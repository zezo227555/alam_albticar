@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">قائمة الطلبة {{ $level }}</b></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
          <th>رقم القيد</th>
          <th>الاسم</th>
          <th>القسم</th>
          <th>رقم الهاتف</th>
          <th>الفصل الدراسي</th>
          <th>صفة القيد</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($sections as $section)
                @foreach ($section->student as $st)
                    <tr>
                        <td>{{ $st->st_id }}</td>
                        <td>{{ $st->name }}</td>
                        <td>{{ $st->section->name }}</td>
                        <td>{{ $st->phone }}</td>
                        <td>الفصل {{ $st->student_semester }}</td>
                        <td>{{ $st->attendance_type }}</td>
                        <td>
                            <a href="{{ route('student.edit', $st->id) }}" class="btn btn-warning">تعديل</a>
                            <a href="{{ route('student.show', $st->id) }}" class="btn btn-secondary">عرض</a>
                            <a href="{{ route('student.student_full_marksheet', $st->id) }}" class="btn btn-info">المواد المنجزة</a>
                            <form action="{{ route('student.destroy', $st->id) }}" method="post" class="d-inline form_delete">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="حذف" class="btn btn-danger delete_button">
                            </form>
                        </td>
                    </tr>
                @endforeach
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
