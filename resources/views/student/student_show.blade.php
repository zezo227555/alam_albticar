@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <h3 class="profile-username text-center">البيانات الشخصية</h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>الاسم</b> <a class="float-right">{{ $student->name }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>الرقم الوطني</b> <a class="float-right">{{ $student->nationla_id }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>الجنسية</b> <a class="float-right">{{ $student->nationality }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>النوع</b> <a class="float-right">{{ $student->gender }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>رقم الهاتف</b> <a class="float-right">{{ $student->phone }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>رقم هاتف ولي الامر</b> <a class="float-right">{{ $student->name }}</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                  <h3 class="profile-username text-center">البيانات الدراسية</h3>
                  <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                      <b>الرقم الدراسي</b> <a class="float-right">{{ $student->st_id }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>القسم الدراسي</b> <a class="float-right">{{ $student->section->name }}</a>
                    </li>
                    <li class="list-group-item">
                      <b>صفة القيد</b> <a class="float-right">{{ $student->attendance_type }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>تاريخ الانتساب</b> <a class="float-right">{{ $student->season->name }} {{ $student->season->created_at->format('Y') }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>تاريخ الانشاء فالنظام</b> <a class="float-right">{{ $student->created_at->format('Y-m-d') }}</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
