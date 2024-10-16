@extends('layouts.body_structer')

@section('content_header')
    الشؤون المالية
@endsection

@section('content')


<div class="card">
    <div class="card-header">
        <h3 class="card-title">الايصالات المالية</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered table-striped w-100 text-center" id="datatable">
        <thead>
        <tr>
            <th>ر.م</th>
          <th>نوع الايصال</th>
          <th>القيمة</th>
          <th>المستخدم</th>
          <th>القسم</th>
          <th>تاريخ الانشاء</th>
          <th>تم الانشاء بواسطة</th>
        </tr>
        </thead>
        <tbody>
            @php
                $co = 1;
            @endphp
            @foreach ($receipts as $receipt)
                <tr>
                    <td>{{ $co }}</td>
                    <td>{{ $receipt->type }}</td>
                    <td>
                        @if ($receipt->value > 0)
                            <span class="btn btn-success">{{ $receipt->value }}</span>
                        @else
                            <span class="btn btn-danger">{{ $receipt->value }}</span>
                        @endif
                    </td>
                    <td>
                        @if ($receipt->type == 'مرتبات')
                            @if (isset($receipt->employee_id))
                                {{ $receipt->employee->name }}
                            @else
                                <span class="btn btn-warning">تم حذف الموظف</span>
                            @endif
                        @elseif($receipt->type == 'تجديد قيد')
                            @if (isset($receipt->student_id))
                                {{ $receipt->student->name }}
                            @else
                                <span class="btn btn-warning">تم حذف الطالب</span>
                            @endif

                        @else
                            الادارة
                        @endif
                    </td>
                    <td>
                        @if (isset($receipt->section->name))
                            {{ $receipt->section->name }}
                        @else
                            الادارة
                        @endif
                    </td>
                    <td>{{ $receipt->created_at->format('Y-m-d | h:i A') }}</td>
                    <td>{{ $receipt->user->username }}</td>
                    @php
                        $co ++;
                    @endphp
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
