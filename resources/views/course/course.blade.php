@extends('layouts.body_structer')

@section('content_header')
    مواد قسم {{ $section->name }}
@endsection

@section('content_action')
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        اضافة مادة <i class="fa-solid fa-plus"></i>
    </button>
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">قائمة المواد</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped text-center w-100" id="datatable">
        <thead>
        <tr>
            <th>ر.م</th>
          <th>الاسم</th>
          <th>الفصل الدراسي</th>
          <th>اجراء</th>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($course as $course)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $course->name }}</td>
                    <td>الفصل {{ $course->semester }}</td>
                    <td>
                        <a href="{{ route('course.edit', $course->id) }}" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form action="{{ route('course.destroy', $course->id) }}" method="post" class="d-inline form_delete">
                            @csrf
                            @method('DELETE')
                            <button role="submit" class="btn btn-danger delete_button"><i class="fa-solid fa-delete-left"></i></button>
                        </form>
                    </td>
                </tr>
                @php
                    $co++ ;
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
                                @if ($section->level == 'بكالوريس')
                                    <div class="form-group mt-2">
                                        <label>اختر الفصل الدراسي</label>
                                        <select class="form-control" name="semester">
                                        <option value="1">الفصل 1</option>
                                        <option value="2">الفصل 2</option>
                                        <option value="3">الفصل 3</option>
                                        <option value="4">الفصل 4</option>
                                        <option value="5">الفصل 5</option>
                                        <option value="6">الفصل 6</option>
                                        <option value="7">الفصل 7</option>
                                        <option value="8">الفصل 8</option>
                                        </select>
                                    </div>
                                @else
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
                                @endif
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق <i class="fa-solid fa-xmark"></i></button>
                <button role="submit" class="btn btn-primary">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
            </form>
            </div>
        </div>
        </div>
    </div>
@endsection
