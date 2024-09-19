@extends('layouts.body_structer')

@section('content_header')
    الاعدادات
@endsection

@section('content')

<div class="row">
    @if (auth()->user()->season_colse_open == 1)
    <div class="col-sm-5">
        <div class="card">
          <div class="card-header">
              <h3 class="card-title">الفصل الدراسي </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">الفصل الدراسي الحالي</span>
                @if (!isset($season))
                    <span class="info-box-number">تم اغلاق اخر فصل</span>
                @else
                    <span class="info-box-number">{{ $season->name }} {{ $season->created_at->format('Y') }}</span>
                @endif
              </div>
              <a href="{{ route('settings_new_season_form') }}" class="btn btn-warning h-75 mt-3">تعديل</a>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>
    </div>
    @endif

    @if (auth()->user()->mark_sheet_hide)
    <div class="col-sm-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">حجب نتائج الفصل الدراسي </h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                    <div class="info-box-content">
                      <form action="{{ route('settings.haid_resault') }}" class="d-inline mx-1" method="GET">
                        @csrf
                        <input type="submit" value="حجب الننائج" class="btn btn-danger">
                      </form>
                      <form action="{{ route('settings.see_resault') }}" class="d-inline mx-1" method="GET">
                        @csrf
                        <input type="submit" value="اظهار النتائج" class="btn btn-success">
                      </form>
                    </div>
                </div>
            </div>
          </div>
      </div>
    @endif
</div>

@endsection


