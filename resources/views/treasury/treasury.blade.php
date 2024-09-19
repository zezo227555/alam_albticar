@extends('layouts.body_structer')

@section('content_header')
    الشؤون المالية
@endsection

@section('content_action')
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
        ايصال صرف
    </button>
    <button type="button" class="btn btn-success mx-3" data-toggle="modal" data-target="#exampleModal2">
        ايصال قبض
    </button>
    <span class="btn btn-secondary float-right">قيمة الخزينة الحالية : {{ $treasury_all->sum('value') }} دل</span>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">الايصالات المالية</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped w-100 text-center" id="datatable">
        <thead>
        <tr>
          <th>نوع الايصال</th>
          <th>القيمة</th>
          <th>تاريخ الانشاء</th>
          <th>تم الانشاء بواسطة</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($treasury as $t)
                <tr>
                    <td>{{ $t->type }}</td>
                    <td>{{ $t->value }}</td>
                    <td>{{ $t->created_at->format('Y-m-d | h:i A') }}</td>
                    <td>{{ $t->user->username }}</td>
                    <td>
                        <form action="{{ route('treasury.destroy', $t->id) }}" method="post" class="d-inline form_delete">
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ايصال صرف</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="card card-danger">
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
                                  <option value="مصروفات اخرى">مصروفات اخرى</option>
                                </select>
                            </div>
                            <input type="text" hidden value="صرف" name="value_type">
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

    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel2">ايصال قبض</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
                                </select>
                            </div>
                            <input type="text" hidden value="قبض" name="value_type">
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

