@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">نتائج القسم <b>
                    @if (count($sections) > 1)
                        كافة الاقسام
                    @else
                        @foreach ($sections as $section)
                            {{ $section->name }} ({{ $section->level }})
                        @endforeach
                    @endif
                </b></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped text-center w-100" id="datatable">
                <thead>
                    <tr>
                        <th>ر.م</th>
                        <th>رقم القيد</th>
                        <th>الاسم</th>
                        <th>القسم</th>
                        <th>الفصل الدراسي</th>
                        <th>صفة القيد</th>
                        <th>النتيجة</th>
                        <th>المعدل العام</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $co = 1;
                    @endphp
                    @foreach ($students as $student)
                        @php
                            $conter = 0;
                            $final_grade = 0;
                            $precent = 0;
                        @endphp
                        <tr>
                            <td>{{ $co }}</td>
                            <td>{{ $student->st_id }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->section->name }}</td>
                            <td>{{ $student->student_semester }}</td>
                            <td>{{ $student->attendance_type }}</td>
                            <td>
                                @if ($student->grade->isEmpty())
                                    <span class="btn btn-warning">لا يوجد كشف درجات</span>
                                @else
                                    @foreach ($student->grade as $g)
                                        @php
                                            $final_grade += $g->semester_work;
                                            $final_grade += $g->final;
                                        @endphp
                                        @if ($g->semester_work + $g->final >= 50)
                                            @php
                                                $conter++;
                                            @endphp
                                        @endif
                                    @endforeach

                                    @if (count($student->grade) == $conter)
                                        <span class="btn btn-success">ناجح</span>
                                    @else
                                        <span class="btn btn-danger">راسب</span>
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if ($student->grade->isEmpty())
                                    <span class="btn btn-secondary">لا يوجد</span>
                                @else
                                    @php
                                        $precent = ($final_grade * 100) / (count($student->grade) * 100);
                                    @endphp
                                    <span class="btn btn-info">{{ number_format($precent, 2) }}</span>
                                @endif
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
