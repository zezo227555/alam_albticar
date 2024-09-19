@extends('layouts.body_structer')

@section('content_header')
    الشؤون المالية
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">تجديد قيد الطلبة للفصل <span class="btn btn-info">{{ $season->name }} {{ $season->created_at->format('Y') }}</span></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped w-100 text-center" id="datatable">
        <thead>
        <tr>
          <td>الاسم</td>
          <td>القسم</td>
          <td>تجديد القيد</td>
          <td>ايصال</td>
        </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>
                        @if ($student->treasury->isEmpty())
                            <form action="{{ route('tresury.create_student_inroll') }}" method="POST">
                                @csrf
                                <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                                <input type="text" name="season_id" value="{{ $season->id }}" hidden>
                                <input type="text" name="section_id" value="{{ $student->section->id }}" hidden>

                                <input type="number" name="value" min="0">
                                <input type="submit" value="حفظ" class="btn btn-warning mx-2">
                            </form>
                        @else
                            <form action="{{ route('tresury.update_student_inroll') }}" method="POST">
                                @csrf

                                @foreach ($student->treasury as $treasury)
                                    <input type="text" name="student_treasury_id" value="{{ $treasury->id }}" hidden>
                                    <input type="number" name="value" value="{{ $treasury->value }}" min="0">
                                @endforeach

                                <input type="submit" value="تعديل" class="btn btn-secondary mx-2">
                            </form>
                        @endif
                    </td>
                    <td>
                        @if ($student->treasury->isEmpty())
                            <span class="btn btn-danger">لا يوجد ايصال</span>
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
  </div>

@endsection
