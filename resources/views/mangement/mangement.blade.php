@extends('layouts.body_structer')

@section('content_header')
    الاقسام الادارية
@endsection

@section('content_action')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        اضافة قسم اداري <i class="fa-solid fa-plus"></i>
    </button>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">الاقسام الادارية</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped w-100 text-center" id="datatable">
        <thead>
        <tr>
            <th>ر.م</th>
          <th>الاسم</th>
          <th>تاريخ الانشاء</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($mangements as $mangement)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $mangement->name }}</td>
                    <td>{{ $mangement->created_at->format('Y-m-d | h:m A') }}</td>
                    <td>
                        <a href="{{ route('mangement.edit', $mangement->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('mangement.destroy', $mangement->id) }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
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

@section('section_modals')
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة قسم دراسي</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">بيانات القسم الاداري</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('mangement.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>اسم القسم</label>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input name="name" type="text" class="form-control" placeholder="ادخل الاسم" value="{{ old('name') }}">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق <i class="fa-solid fa-xmark"></i></button>
                <button role="submit" class="btn btn-primary">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

