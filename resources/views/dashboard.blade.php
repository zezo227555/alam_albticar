@extends('layouts.body_structer')

@section('content')
    <div class="row">
        <div class="col-6 mb-3">
            <div class="callout callout-info">
                مرحبا بك <b>{{ Auth::user()->username }}</b>
            </div>
        </div>
        <div class="col-6">
            <div class="callout callout-warning mb-3">
                <p>
                    الفصل الدراسي الحالي <b>{{ $season->name }} {{ $season->created_at->format('Y') }}</b>
                </p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3>المستخدمين</h3>
                </div>
                <div class="card-body">
                    <canvas id="myChartDonat" class="h-75 w-75"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h3>طلبة الاقسام</h3>
                </div>
                <div class="card-body">
                    <canvas id="myChartBar" class="h-100 w-100"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('costome_section_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChartBar');
        const donat = document.getElementById('myChartDonat');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @foreach ($sections as $section)
                        '{{ $section->name }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'الطلبة',
                    data: [
                        @foreach ($sections as $section)
                            '{{ $section->student_count }}',
                        @endforeach
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(donat, {
            type: 'doughnut',
            data: {
                labels: ['المدرسين', 'الموظفين', 'مستخدمو النظام', ],
                datasets: [{
                    label: 'العدد',
                    data: [{{ $teachers }}, {{ $employee }}, {{ $users }}, ],
                    borderWidth: 1
                }]
            },
        });
    </script>
@endsection
