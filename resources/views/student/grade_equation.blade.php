@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')

<form action="{{ route('student.grade_equation_create') }}" method="POST">
    @csrf
    @if ($section->level == 'بكالوريس')
                                    <div class="form-group mt-2 w-25">
                                        <label>اختر الفصل الدراسي</label>
                                        <select class="form-control" name="semester">
                                        <option value="1" @selected($student->student_semester == 1)>الفصل 1</option>
                                        <option value="2" @selected($student->student_semester == 2)>الفصل 2</option>
                                        <option value="3" @selected($student->student_semester == 3)>الفصل 3</option>
                                        <option value="4" @selected($student->student_semester == 4)>الفصل 4</option>
                                        <option value="5" @selected($student->student_semester == 5)>الفصل 5</option>
                                        <option value="6" @selected($student->student_semester == 6)>الفصل 6</option>
                                        <option value="7" @selected($student->student_semester == 7)>الفصل 7</option>
                                        <option value="8" @selected($student->student_semester == 8)>الفصل 8</option>
                                        </select>
                                    </div>
                                @else
                                    <div class="form-group mt-2 w-25">
                                        <label>اختر الفصل الدراسي</label>
                                        <select class="form-control" name="semester">
                                        <option value="1" @selected($student->student_semester == 1)>الفصل 1</option>
                                        <option value="2" @selected($student->student_semester == 2)>الفصل 2</option>
                                        <option value="3" @selected($student->student_semester == 3)>الفصل 3</option>
                                        <option value="4" @selected($student->student_semester == 4)>الفصل 4</option>
                                        <option value="5" @selected($student->student_semester == 5)>الفصل 5</option>
                                        <option value="6" @selected($student->student_semester == 6)>الفصل 6</option>
                                        </select>
                                    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">معادلة مواد الطالب {{ $student->name }} بقسم {{ $section->name }} ({{ $section->level }})</h3>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-bordered table-striped text-center w-100" id="datatable">
            <thead>
            <tr>
                <th>المادة</th>
                <th>الفصل الدراسي</th>
                <th>النصفي</th>
                <th>النهائي</th>
                <th>المجموع</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    @php
                        $found = false;
                        $grade_id = 0;
                        $semester_work = 0;
                        $final = 0;
                    @endphp
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>الفصل {{ $course->semester }}</td>

                        @foreach ($grades as $grade)
                            @if ($grade->course_id == $course->id)
                                @php
                                    $found = true;
                                    $grade_id = $grade->id;
                                    $semester_work = $grade->semester_work;
                                    $final = $grade->final;
                                @endphp
                            @endif
                        @endforeach
                        @if ($found)
                            <td>
                                <input type="number" class="form-control d-inline" name="old_semester_work[{{ $grade_id }}]" value="{{ $semester_work }}" min="0" max="40">
                            </td>
                            <td>
                                <input type="number" class="form-control d-inline" name="old_final[{{ $grade_id }}]" value="{{ $final }}" min="0" max="60">
                            </td>
                            <td>
                                {{ $semester_work + $final }}
                            </td>
                        @else
                            <td>
                                <input type="number" class="form-control d-inline" name="semester_work[{{ $course->id }}]" min="0" max="40">
                            </td>
                            <td>
                                <input type="number" class="form-control d-inline" name="final[{{ $course->id }}]" min="0" max="60">
                            </td>
                            <td>0</td>
                        @endif

                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="card-footer">
            <input type="text" name="student_id" value="{{ $student->id }}" hidden>
            <input type="text" name="section_id" value="{{ $section->id }}" hidden>
            <button role="submit" class="btn btn-primary w-25">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
        </div>
    </div>
</form>
@endsection
