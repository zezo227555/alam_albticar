@extends('layouts.body_structer')

@section('content_header')
    الشؤون المالية
@endsection

@section('content_action')
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        ايصال صرف <i class="fa-solid fa-money-bill"></i>
    </button>
    <button type="button" class="btn btn-success mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal2">
        ايصال قبض <i class="fa-solid fa-money-bill"></i>
    </button>
    <span class="btn btn-secondary float-right">قيمة الخزينة الحالية : {{ $treasury_all->sum('value') }} دل <i
            class="fa-solid fa-sack-dollar"></i></span>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">الايصالات المالية</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100 text-center" id="datatable">
                <thead>
                    <tr>
                        <th>ر.م</th>
                        <th>نوع الايصال</th>
                        <th>القيمة</th>
                        <th>المستخدم</th>
                        <th>تاريخ الانشاء</th>
                        <th>تم الانشاء بواسطة</th>
                        <th>اجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $co = 1;
                    @endphp
                    @foreach ($treasury as $t)
                        <tr>
                            <td>{{ $co }}</td>
                            <td>{{ $t->type }}</td>
                            <td>{{ $t->value }}</td>
                            <td>
                                @if ($t->type == 'مرتبات')
                                    @if (isset($t->employee_id))
                                        {{ $t->employee->name }}
                                    @elseif (isset($t->teacher_id))
                                        {{ $t->teacher->name }}
                                    @else
                                        <span class="btn btn-warning">تم حذف الموظف</span>
                                    @endif
                                @elseif($t->type == 'تجديد قيد')
                                    @if (isset($t->student_id))
                                        {{ $t->student->name }}
                                    @else
                                        <span class="btn btn-warning">تم حذف الطالب</span>
                                    @endif
                                @else
                                    الادارة
                                @endif
                            </td>
                            <td>{{ $t->created_at->format('Y-m-d | h:i A') }}</td>
                            <td>{{ $t->user->username }}</td>
                            <td>
                                <a href="{{ route('treasury.show', $t->id) }}" class="btn btn-info"><i
                                        class="fa-solid fa-eye"></i></a>
                                <form action="{{ route('treasury.destroy', $t->id) }}" method="post"
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
        <div class="card-footer">
            {{ $treasury->links() }}
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


@section('section_modals')

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ايصال قبض</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">بيانات الايصال</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('treasury.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <label>القيمة</label>
                                @error('value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" min="0" class="form-control" name="value">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label>نوع الايصال</label>
                                    <select class="form-control" name="type">
                                        <option value="ايداع قيمة">ايداع قيمة</option>
                                        <option value="ايداع قيمة">حوالة نقدية</option>
                                        <option value="ايداع قيمة">اخرى</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>الوصف</label>
                                    <textarea name="discreption" class="form-control" rows="3" placeholder="أكتب وصفا للأيصال"></textarea>
                                </div>
                                <input type="text" hidden value="قبض" name="value_type">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button role="submit" class="btn btn-primary">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ايصال صرف</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">بيانات الايصال</h3>
                        </div>
                        <form role="form" action="{{ route('treasury.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <label>القيمة</label>
                                @error('value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" min="0" class="form-control" name="value">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label>نوع الايصال</label>
                                    <select class="form-control" name="type">
                                        <option value="مصروفات اخرى">صيانة</option>
                                        <option value="مصروفات اخرى">سداد فواتير</option>
                                        <option value="مصروفات اخرى">مصروفات اخرى</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>الوصف</label>
                                    <textarea name="discreption" class="form-control" rows="3" placeholder="أكتب وصفا للأيصال"></textarea>
                                </div>
                                <input type="text" hidden value="صرف" name="value_type">
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button role="submit" class="btn btn-primary">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('data_tabel_altered')
    <script>
        $('#datatable').DataTable().destroy();
        $('#datatable').DataTable({
            dom: '<"row mb-2"<"col-sm-6"f><"col-sm-6 text-right"B>>' +
                't' +
                "<'row mt-2'<'col-sm-7'p>>",
            buttons: [
                'excel',
                'print',
                {
                    extend: 'colvis',
                    text: 'اظهار - اخفاء'
                },
            ],
            language: {
                search: "بحث:",
            },
            paging: false,
            pageLength: 50
        });
    </script>
@endsection
