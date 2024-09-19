@extends('layouts.body_structer')

@section('content_header')
    التقارير
@endsection

@section('content')

<form action="{{ route('student.deactivate_multiple_student') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تجديد قيد طلبة قسم <b>
                @isset($section)
                    {{ $section->name }} ({{ $section->level }})
                @endisset
            </b> للفصل <span class="btn btn-info">{{ $season->name }} {{ $season->created_at->format('Y') }}</span></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <table class="table table-bordered table-striped w-100 text-center" id="datatable">
            <thead>
            <tr>
            <td class="text-center">رقم القيد</td>
            <td>الاسم</td>
            <td>صفة القيد</td>
            <td>رقم الهاتف</td>
            <td>ايصال</td>
            </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td class="text-center">{{ $student->st_id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->attendance_type }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>
                            @if ($student->treasury->isEmpty())
                                <input name="stop_st_id[]" type="checkbox" value="{{ $student->id }}" checked="">
                                <label class="text-muted">لا يوجد ايصال</label>
                            @else
                                @foreach ($student->treasury as $treasury)
                                <form action="{{ route('treasury.student_enroll_receipt') }}">
                                    <input type="text" name="receipt_id" value="{{ $treasury->id }}" hidden>
                                    <input type="submit" value="ايصال تجديد القيد" class="btn btn-success">
                                </form>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="card-footer">
            <input type="submit" value="ايقاف قيد الطلبة" class="btn btn-danger w-25">
        </div>
    </div>
</form>
@endsection
