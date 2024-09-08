@extends('layouts.body_structer')

@section('content_header')
    الشؤون المالية
@endsection

@section('content')
<form action="{{ route('treasury.student_enroll') }}" method="GET">
    @csrf
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">تجديد قيد الطلبة </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>الفصل الدراسي</label>
                    @error('season_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="season_id" class="mySelect form-control select2" style="width: 100%;">
                        @foreach ($seasons as $season)
                            <option value="{{ $season->id }}">{{ $season->name }} {{ $season->created_at->format('Y') }} {{ $season->active == 1 ? '(الفصل الحالي)' : '' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>القسم</label>
                    @error('section_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="section_id" class="mySelect form-control select2" style="width: 100%;">
                        <option>اختر القسم</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" value="بحث" class="btn btn-primary w-25">
      </div>
    </div>
</form>

@endsection


