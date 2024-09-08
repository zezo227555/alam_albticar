@extends('layouts.body_structer')

@section('content_header')
    المستخدمين
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
          <th>رقم الهاتف</th>
          <th>اسم المستخدم</th>
          <th>الصلاحية</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">تعديل</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline form_delete">
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
