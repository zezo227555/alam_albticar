@extends('layouts.receipt_structer')

@section('receipt_style')
    <style>
        .rtl{
            direction: rtl;
        }

        body{margin-top:20px;
            background-color:#eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0,0,0,.125);
            border-radius: 1rem;
        }
    </style>
@endsection

@section('receipt_content')
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="mb-4">
                               <h2 class="mb-1 text-muted">معهد عالم الابتكار للمهن الشاملة</h2>
                            </div>
                            <div class="text-muted">
                                <p><i class="fa fa-phone"></i> 094-2801398</p>
                                <p><i class="fa fa-phone"></i> 091-0084847</p>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-muted">
                                    <h5 class="font-size-16 mb-3">ايصال صرف مرتبات عن الفصل الدراسي {{ $receipt->season->name }} {{ $receipt->season->created_at->format('Y') }} للموظف/ة</h5>
                                    <h5 class="font-size-15 mb-2">{{ $receipt->employee->name }}</h5>
                                    <p class="mb-1">{{ $receipt->employee->phone }}</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-sm-6">
                                <div class="text-muted text-sm-end">
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">تاريخ الانشاء</h5>
                                        <p>{{ $receipt->created_at->format('Y/m/d') }}</p>
                                    </div>
                                    <div class="mt-4">
                                        <h5 class="font-size-15 mb-1">نوع الايصال</h5>
                                        <p>{{ $receipt->type }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="py-2">
                            <h5 class="font-size-15">تفاصيل</h5>

                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-centered mb-0">
                                    <thead>
                                        <tr>
                                            <th>الفصل الدراسي</th>
                                            <th>القيمة المدفوعة</th>
                                            <th>المتبقي</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        <tr>
                                            <td>{{ $receipt->season->name }} {{ $receipt->season->created_at->format('Y') }}</td>
                                            <td><span class="btn btn-success">{{ $receipt->value }} دل</span></td>
                                            <td><span class="btn btn-danger">{{ $receipt->employee->salary - $receipt->value }} دل</span></td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div><!-- end table responsive -->
                            <div class="d-print-none mt-4">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-primary me-1">طباعة <i class="fa fa-print"></i></a>
                                    <a href="{{ route('employee.index') }}" class="btn btn-secondary mx-3">رجوع</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
</div>
@endsection
