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
            <th>ر.م</th>
          <td>الاسم</td>
          <td>الهاتف</td>
          <td>القسم</td>
          <td>تجديد القيد</td>
          <td>ايصال</td>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($students as $student)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->phone }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>
                        @if ($student->treasury->isEmpty())
                            <form action="{{ route('tresury.create_student_inroll') }}" method="POST">
                                @csrf
                                <input type="text" name="student_id" value="{{ $student->id }}" hidden>
                                <input type="text" name="season_id" value="{{ $season->id }}" hidden>
                                <input type="text" name="section_id" value="{{ $student->section->id }}" hidden>

                                <input type="number" name="value" min="0" value="{{ $student->fees }}" class="form-control d-inline w-25">
                                <button role="submit" class="btn btn-warning mx-2"><i class="fa-solid fa-floppy-disk"></i></button>
                            </form>
                        @else
                            <form action="{{ route('tresury.update_student_inroll') }}" method="POST">
                                @csrf

                                @foreach ($student->treasury as $treasury)
                                    <input type="text" name="student_treasury_id" value="{{ $treasury->id }}" hidden>
                                    <input type="number" name="value" value="{{ $treasury->value }}" min="0" class="form-control d-inline w-25">
                                @endforeach

                                <button role="submit" class="btn btn-secondary mx-2"><i class="fa-solid fa-pen-to-square"></i></button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if ($student->treasury->isEmpty())
                            <span class="btn btn-danger">لايوجد <i class="fa-solid fa-ban"></i></span>
                        @else
                            @foreach ($student->treasury as $treasury)
                                <form action="{{ route('treasury.student_enroll_receipt') }}">
                                    <input type="text" name="receipt_id" value="{{ $treasury->id }}" hidden>
                                    <button role="submit" class="btn btn-success">الايصال <i class="fa-solid fa-receipt"></i></button>
                                </form>
                            @endforeach
                        @endif
                    </td>
                </tr>
                @php
                    $co ++;
                @endphp
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
