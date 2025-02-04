@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content_action')
@endsection

@section('content')
    <form action="{{ route('grade.update_grade_sheet') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center" id="datatable" data-page-length='25'>
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم القيد</th>
                            @foreach ($courses as $course)
                                <th>{{ $course->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->st_id }}</td>
                                @foreach ($student->grade as $grades)
                                    <td class="px-3">
                                        <div class="form-floating">
                                            <input class="form-control d-inline" type="number"
                                                name="semester_work[{{ $grades->id }}]"
                                                value="{{ $grades->semester_work }}" min="0" max="40"
                                                style="width: 120px;">
                                            <label for="floatingInputGrid">اعمال السنة</label>
                                        </div>
                                        <div class="form-floating mt-1">
                                            <input class="form-control d-inline" type="number"
                                                name="final[{{ $grades->id }}]" value="{{ $grades->final }}"
                                                min="0" max="60" style="width: 120px;">
                                            <label for="floatingInputGrid">النهائي</label>
                                        </div>
                                        <div class="form-floating mt-1">
                                            <input type="number" class="form-control" style="width: 120px;"
                                                id="floatingInputGrid" disabled value="{{ $grades->total }}">
                                            <label for="floatingInputGrid">المجموع</label>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button role="submit" class="btn btn-primary w-25">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
            </div>
        </div>
    </form>
@endsection

@section('costome_section_scripts')
    <script>
        $('#datatable').DataTable().destroy();
        $('#datatable').DataTable({
            dom: '<"row mb-2"<"col-sm-6"f><"col-sm-2 text-end pt-2"l><"col-sm-4 text-end"B>>' +
                't' +
                "<'row mt-2'<'col-sm-7'p>>",
            buttons: [{
                    extend: 'excel',
                    text: '<i class="bi bi-filetype-csv"></i>'
                },
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer"></i>'
                },
                {
                    extend: 'colvis',
                    text: 'اظهار - اخفاء'
                },
            ],
            scrollY: 500,
            language: {
                search: "بحث:",
                emptyTable: "لا توجد اي سجلات",
                lengthMenu: "عرض: _MENU_",
            },
            paging: true,
            pageLength: 50
        });
    </script>
@endsection
