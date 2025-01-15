@extends('layouts.body_structer')

@section('content_header')
    الشئوون الادارية
@endsection

@section('content_action')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        اضافة مدرس <i class="fa-solid fa-user-plus"></i>
    </button>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">المدرسين</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped text-center w-100" id="datatable">
                <thead>
                    <tr>
                        <th>ر.م</th>
                        <th>الاسم</th>
                        <th>الدرجة العلمية</th>
                        <th>الهاتف</th>
                        <th>اجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $co = 1;
                    @endphp
                    @foreach ($teachers as $teacher)
                        <tr>
                            <td>{{ $co }}</td>
                            <td>{{ $teacher->name }}</td>
                            <td>{{ $teacher->degree }}</td>
                            <td>{{ $teacher->phone }}</td>
                            <td>
                                <a href="{{ route('teacher.teacherSalary', $teacher->id) }}" class="btn btn-success"><i
                                        class="fa-solid fa-money-bills"></i></a>
                                <a href="{{ route('teacher.courses', $teacher->id) }}" class="btn btn-warning"><i
                                        class="fa-solid fa-book"></i></a>
                                <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-info"><i
                                        class="fa-solid fa-user-pen"></i></a>
                                <a href="{{ route('teacher.show', $teacher->id) }}" class="btn btn-secondary"><i
                                        class="fa-solid fa-eye"></i></a>
                                <form action="{{ route('teacher.destroy', $teacher->id) }}" method="post"
                                    class="d-inline form_delete">
                                    @csrf
                                    @method('DELETE')
                                    <button role="submit" class="btn btn-danger delete_button"><i
                                            class="fa-solid fa-delete-left"></i></button>
                                </form>
                            </td>
                        </tr>
                        @php
                            $co++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('section_modals')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة مدرس</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">بيانات المدرس</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('teacher.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>الاسم الرباعي</label>
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label>المؤهل العلمي</label>
                                    @error('section_id')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <select name="degree" class="form-control" style="width: 100%;">
                                        <option value="بكالوريس">بكالوريس</option>
                                        <option value="ماجستير">ماجستير</option>
                                        <option value="دكتوراة">دكتوراة</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    @error('phone')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input name="phone" type="text" class="form-control" placeholder="09XXXXXXXX"
                                        value="{{ old('phone') }}">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary w-25">حفظ <i
                                        class="fa-solid fa-floppy-disk"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('costome_section_scripts')
    <script>
        $('.form_delete').on('click', function(e) {
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
