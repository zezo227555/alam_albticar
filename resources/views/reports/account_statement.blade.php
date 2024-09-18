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
          <th>نوع الايصال</th>
          <th>القيمة</th>
          <th>القسم</th>
          <th>تاريخ الانشاء</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($receipts as $receipt)
                <tr>
                    <td>{{ $receipt->type }}</td>
                    <td>
                        @if ($receipt->value > 0)
                            <span class="btn btn-success">{{ $receipt->value }}</span>
                        @else
                            <span class="btn btn-danger">{{ $receipt->value }}</span>
                        @endif
                    </td>
                    <td>
                        @if (isset($receipt->section->name))
                            {{ $receipt->section->name }}
                        @else
                            الادارة العامة
                        @endif
                    </td>
                    <td>{{ $receipt->created_at->format('Y-m-d | h:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>

@endsection
