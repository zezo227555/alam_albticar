@extends('layouts.receipt_structer')

@section('receipt_content')
    <div class="container p-3 rtl">
        <div class="row">
            <div class="col-6 pt-5">
                <h1>دولة ليبيا</h1>
                <h1>معهد {{ $student->section->level == 'متوسط' ? 'دنيا' : 'عالم' }} الابتكار</h1>
                <h5>للمهن الشاملة - سبها</h5>
            </div>
            <div class="col-6 text-right">
                @if ($student->section->level == 'متوسط')
                    <img src="{{ asset('images/low.jpg') }}" width="200" height="200">
                @else
                    <img src="{{ asset('images/high.jpg') }}" width="200" height="200">
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 text-center">
                <h2>بطاقة تقدير درجات لفصل</h2>
                <h4>تخصص {{ $student->section->name }}</h4>
            </div>
            <div class="col-4 text-right">
                <p>التاريخ: {{ Carbon\Carbon::now()->format('Y/m/d') }}</p>
                @if ($student->section->level == 'عالي')
                    <p class="text-center" style="padding-right: 8rem;">الاشاري:</p>
                @endif
            </div>
        </div>
        <div class="container px-5 mt-5 text-center">
            <div class="row">
                <div class="col-6">اسم الطالب: {{ $student->name }}</div>
                <div class="col-6">الفصل الدراسي: {{ $student->student_semester }}</div>
            </div>
        </div>
        <div class="container mt-5">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>ر.م</th>
                        <th>اسم المادة</th>
                        <th>الاعمال</th>
                        <th>النهائي</th>
                        <th>المجموع</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $conter = 1;
                        $total_conter = 0;
                        $total_percent = 0;
                    @endphp
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $conter }}</td>
                            <td>{{ $grade->course->name }}</td>
                            <td>{{ $grade->semester_work }}</td>
                            <td>{{ $grade->final }}</td>
                            <td>{{ $grade->total }}</td>
                        </tr>
                        @php
                            $conter ++;
                            $total_conter += $grade->total;
                        @endphp
                    @endforeach
                    <tr>
                        <td colspan="4">المجموع</td>
                        <td>{{ $total_conter }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">المعدل</td>
                        <td>
                            @if (!$grades->isEmpty())
                                @php
                                    $total_percent = ($total_conter * 100) / (count($grades) * 100);
                                @endphp
                            @endif
                            {{ number_format($total_percent, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">التقدير</td>
                        <td>
                            @if ($total_percent >= 50 && $total_percent < 65)
                                مقبول
                            @elseif ($total_percent >= 65 && $total_percent < 75)
                                جيد
                            @elseif ($total_percent >= 75 && $total_percent < 85)
                                جيد جدا
                            @elseif ($total_percent >= 85)
                                ممتاز
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="container text-center" style="margin-top: 8rem;">
            <div class="row">
                <div class="col-4">
                    <h5>يعتمد</h5>
                    <h5>قسم الدراسة و الامتحانات - سبها</h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
@endsection
