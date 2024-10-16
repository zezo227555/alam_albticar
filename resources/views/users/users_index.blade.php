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
            <th>ر.م</th>
          <th>الاسم</th>
          <th>رقم الهاتف</th>
          <th>اسم المستخدم</th>
          <th>تاريخ الانشاء</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->created_at->format('Y-d-m | h:m A') }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info"><i class="fa-solid fa-user-pen"></i></a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline form_delete">
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
