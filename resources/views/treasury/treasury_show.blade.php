@extends('layouts.body_structer')

@section('content_header')
    الشؤون المالية
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <h3 class="profile-username text-center">تفاصيل الايصال</h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>نوع  الايصال</b> <a class="float-right">{{ $treasury->type }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>القيمة</b> <a class="float-right">{{ $treasury->value }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>الوصف</b> <a class="float-right">{{ $treasury->discreption }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>الفصل الدراسي</b> <a class="float-right">{{ $treasury->season->name }} {{ $treasury->season->created_at->format('Y') }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>تم الانشاء بواسطة</b> <a class="float-right">{{ $treasury->user->name }}</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
