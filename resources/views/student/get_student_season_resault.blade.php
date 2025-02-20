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
        <div class="card-body">
            @if ($grades->isEmpty())
                <div class="alert alert-info">لم يتم تنزيل موادك بعد</div>
            @else
                <div class="accordion" id="student_grades">
                    @foreach ($grades as $grade)
                        <div class="accordion-item">
                            <h2 class="accordion-header"> <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#grade{{ $grade->id }}"
                                    aria-expanded="false" aria-controls="grade{{ $grade->id }}">
                                    {{ $grade->course->name }}
                                    @if ($grade->semester_work + $grade->final >= 50)
                                        <span class="text-success mx-3">ناجح</span>
                                    @else
                                        <span class="text-danger mx-3">راسب</span>
                                    @endif
                                </button>
                            </h2>
                            <div id="grade{{ $grade->id }}" class="accordion-collapse collapse"
                                data-bs-parent="#grade{{ $grade->id }}">
                                <div class="accordion-body">

                                    <span class="btn btn-secondary me-2 mt-1">درجة النصفي: {{ $grade->semester_work }}</span>
                                    <span class="btn btn-secondary me-2 mt-1">درجة الامتحان النهائي: {{ $grade->final }}</span>
                                    <span class="btn btn-info me-2 mt-1">المجموع الكلي: {{ $grade->semester_work + $grade->final }}</span>
                                </div>
                            </div>
                        </div> @php
                            $final_grade += $grade->semester_work;
                            $final_grade += $grade->final;
                        @endphp
                    @endforeach
                </div>
                @php
                    $percentage = ($final_grade * 100) / (count($grades) * 100);
                @endphp
            @endif
        </div>
        <div class="card-footer">
            @isset($percentage)
                <h5>المعدل العام للفصل <span class="btn btn-info">{{ number_format($percentage, 2) }}</span></h5>
            @endisset
        </div>
    </div>
@endsection
