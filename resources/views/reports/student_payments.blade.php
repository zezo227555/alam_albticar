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
                <th>ر.م</th>
                <th class="text-center">رقم القيد</th>
                <th>الاسم</th>
                <th>الرقم الوطني</th>
                <th>رقم الهاتف</th>
                <th>المدفوع</th>
                <th>المتبقي</th>
                <th>ايصال</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $co = 1;
                    $value = 0;
                @endphp
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $co }}</td>
                        <td class="text-center">{{ $student->st_id }}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->nationla_id }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>
                            @if ($student->treasury->isEmpty())
                                0
                            @else
                                @foreach ($student->treasury as $treasury)
                                    {{ $treasury->value }}
                                    @php
                                        $value = $treasury->value;
                                    @endphp
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if ($student->treasury->isEmpty())
                                {{ $student->fees }}
                            @else
                                {{ $student->fees - $value }}
                            @endif
                        </td>
                        <td>
                            @if ($student->treasury->isEmpty())
                                <input type="checkbox" name="stop_st_id[]" value="{{ $student->id }}" class="btn-check" id="btn-check-outlined{{ $co }}" autocomplete="off" checked="">
                                <label class="btn btn-outline-danger" for="btn-check-outlined{{ $co }}"><i class="fa-solid fa-ban"></i></label>
                            @else
                                @foreach ($student->treasury as $treasury)
                                <form action="{{ route('treasury.student_enroll_receipt') }}">
                                    <input type="text" name="receipt_id" value="{{ $treasury->id }}" hidden>
                                    <button role="submit" class="btn btn-success"><i class="fa-solid fa-receipt"></i></button>
                                </form>
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    @php
                        $co ++;
                        $value = 0;
                    @endphp
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
