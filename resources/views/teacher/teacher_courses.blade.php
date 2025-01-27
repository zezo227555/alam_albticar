@extends('layouts.body_structer')

@section('content_header')
    الشئوون الادارية
@endsection

@section('content_action')
    <form action="{{ route('teacher.teacherCoursesCreate') }}" method="post">
        @csrf
        @method('POST')
        <div class="form-group">
            <label>المواد</label>
            @error('course_id')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <select name="course_id" class="mySelect form-control select2" style="width: 100%;">
                <option value="">اختر مادة</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }} {{ $course->section->name }} ({{ $course->section->level }})</option>
                @endforeach
            </select>
        </div>
        <input type="text" name="teacher_id" value="{{ $teacher->id }}" hidden>
        <button role="submit" class="btn btn-success w-100">اضافة مادة للمدرس <i class="fa-solid fa-address-book"></i></button>
    </form>
@endsection

@section('content')

<form action="{{ route('teacher.teacherCoursesDestroy') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">قائمة المواد للمدرس ({{ $teacher->name }})</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered table-striped text-center w-100" id="datatable">
            <thead>
            <tr>
                <th>ر.م</th>
              <th>المادة</th>
              <th>القسم</th>
              <th>تاريخ الاضافة</th>
              <th>تحديد</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $co = 1;
                @endphp
                @foreach ($teacher_courses as $teacher_course)
                    <tr>
                        <td>{{ $co }}</td>
                        <td>{{ $teacher_course->course->name }}</td>
                        <td>{{ $teacher_course->section->name }} ({{ $teacher_course->section->level }})</td>
                        <td>{{ $teacher_course->created_at->format('Y-m-d') }}</td>
                        <td>
                            <div class="form-check">
                                <input class="form-check w-100 h-100" name="course_id[]" type="checkbox" value="{{ $teacher_course->id }}">
                            </div>
                        </td>
                    </tr>
                    @php
                        $co++ ;
                    @endphp
                @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer">
            <button role="submit" class="btn btn-danger w-25 form_delete">ازالة المواد <i class="fa-solid fa-delete-left"></i></button>
        </div>
    </div>
</form>

@endsection

@section('costome_section_scripts')
    <script>
        $('.form_delete').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل انت متأكد من بأنك تريد ازلة المواد ؟',
            text: 'سيتم ازالة المواد من سجل المدرس',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم قم بالازالة',
            cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endsection
