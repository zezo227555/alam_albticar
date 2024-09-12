@extends('layouts.body_structer')

@section('content_header')
    الاقسام الدراسية
@endsection

@section('content_action')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        اضافة قسم
    </button>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">التخصصات</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped w-100 text-center" id="datatable">
        <thead>
        <tr>
          <th>الاسم</th>
          <th>النوع</th>
          <th>تاريخ الانشاء</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($section as $section)
                <tr>
                    <td>{{ $section->name }}</td>
                    <td>{{ $section->level }}</td>
                    <td>{{ $section->created_at->format('Y-m-d') }}</td>
                    <td>
                        <a href="{{ route('course.index', $section->id) }}" class="btn btn-secondary">قائمة المواد</a>
                        <a href="{{ route('section.edit', $section->id) }}" class="btn btn-info">تعديل</a>
                        <form action="{{ route('section.destroy', $section->id) }}" method="post" class="d-inline form_delete">
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
            <h5 class="modal-title" id="exampleModalLabel">اضافة قسم دراسي</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">بيانات القسم الدراسي</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('section.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>اسم القسم</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{ old('name') }}">
                            </div>
                            <div class="form-group mt-2">
                                <label>نوع القسم</label>
                                @error('level')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <select class="custom-select" name="level">
                                  <option value="متوسط">متوسط</option>
                                  <option value="عالي">عالي</option>
                                  <option value="بكالوريس">بكالوريس</option>
                                </select>
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

