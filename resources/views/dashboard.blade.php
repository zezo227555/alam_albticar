@extends('layouts.body_structer')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{ count($students) }}</h3>

          <p>عدد الطلبة</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ count($teachers) }}</h3>

          <p>عدد المدرسين</p>
        </div>
        <div class="icon">
          <i class="fas fa-user"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{ count($sections) }}</h3>

          <p>عدد التخصصات</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-plus"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small card -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{ $season->name }} {{ $season->created_at->format('Y') }}</h3>

          <p>الفصل الحالي</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-pie"></i>
        </div>
      </div>
    </div>
    <!-- ./col -->
</div>


@endsection
