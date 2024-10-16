@extends('layouts.body_structer')

@section('content_header')
    شؤون الموظفين
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <h3 class="profile-username text-center">البيانات الشخصية</h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>الاسم</b> <a class="float-right">{{ $teacher->name }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>رقم الهاتف</b> <a class="float-right">{{ $teacher->phone }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>الدرجة العملية</b> <a class="float-right">{{ $teacher->degree }}</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <h3 class="profile-username text-center">البيانات الوظيفية</h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>تاريخ الانشاء</b> <a class="float-right">{{ $teacher->created_at->format('Y-m-d') }}</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
