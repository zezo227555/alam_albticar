@extends('layouts.student_body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')
@php
    $final_grade = 0;
@endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">كشف درجات الطالب <span class="btn btn-secondary">{{ $student->name }}</span></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            @if ($grades->isEmpty())
                <div class="alert alert-info">لم يتم تنزيل موادك بعد</div>
            @else
                <table class="table table-bordered table-striped text-center w-100" id="datatable">
                    <thead>
                    <tr>
                        <th>ر.م</th>
                        <th>المادة</th>
                        <th>اعمال السنة</th>
                        <th>النهائي</th>
                        <th>المجموع</th>
                        <th>النتيجة</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $co = 1;
                        @endphp
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $co }}</td>
                                <td>{{ $grade->course->name }}</td>
                                <td>{{ $grade->semester_work }}</td>
                                <td>{{ $grade->final }}</td>
                                <td>{{ $grade->semester_work + $grade->final }}</td>
                                <td>
                                    @if ($grade->semester_work + $grade->final >= 50)
                                        <span class="btn btn-success">ناجح</span>
                                    @else
                                        <span class="btn btn-danger">راسب</span>
                                    @endif
                                </td>
                                @php
                                    $final_grade += $grade->semester_work;
                                    $final_grade += $grade->final;
                                @endphp
                            </tr>
                            @php
                                $co ++;
                            @endphp
                        @endforeach
                        @php
                            $percentage = ($final_grade * 100) / (count($grades) * 100);
                        @endphp
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            @isset($percentage)
                <h5>المعدل العام للفصل <span class="btn btn-info">{{ $percentage }}</span></h5>
            @endisset
        </div>
    </div>
</form>
@endsection




