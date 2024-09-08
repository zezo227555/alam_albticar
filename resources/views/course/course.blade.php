@extends('layouts.body_structer')

@section('content_header')
    مواد قسم {{ $section->name }}
@endsection

@section('content_action')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        اضافة مادة
    </button>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">مستخدمو النظام</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
          <th>الاسم</th>
          <th>الفصل الدراسي</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($course as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>الفصل {{ $course->semester }}</td>
                    <td>
                        <a href="{{ route('course.edit', $course->id) }}" class="btn btn-info">تعديل</a>
                        <form action="{{ route('course.destroy', $course->id) }}" method="post" class="d-inline form_delete">
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


@section('section_modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">اضافة مادة للقسم</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">بيانات المادة</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('course.store', $section->id) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>اسم المادة</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{ old('name') }}">
                                <div class="form-group mt-2">
                                    <label>اختر الفصل الدراسي</label>
                                    <select class="form-control" name="semester">
                                      <option value="1">الفصل 1</option>
                                      <option value="2">الفصل 2</option>
                                      <option value="3">الفصل 3</option>
                                      <option value="4">الفصل 4</option>
                                      <option value="5">الفصل 5</option>
                                      <option value="6">الفصل 6</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <input type="submit" value="حفظ" class="btn btn-primary">
            </form>
            </div>
        </div>
        </div>
    </div>
@endsection
