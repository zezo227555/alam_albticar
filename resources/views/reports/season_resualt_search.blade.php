@extends('layouts.body_structer')

@section('content_header')
    نتائج الفصل الدراسي
@endsection

@section('content')
    <form action="{{ route('reports.season_resault_search') }}" method="GET">
        @csrf
        <div class="card card-primary">
            <div class="card-header">اختيار القسم الدراسي</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>القسم</label>
                            @error('section_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                            <select name="section_id" class="mySelect form-control select2" style="width: 100%;">
                                <option value="all">الكل</option>
                                @foreach ($sections as $section)
                                    <option value="{{ $section->id }}">{{ $section->name }} ({{ $section->level }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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
                </div>
            </div>
            <div class="card-footer text-center">
                <button role="submit" class="btn btn-primary w-50">بحث <i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </form>
@endsection
