@extends('layouts.body_structer')

@section('content_header')
    شؤون الموظفين
@endsection

@section('content')
<form action="" method="post">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">صرف مرتب الموظف {{ $employee->name }}</h3>
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>القيمة</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                    </div>
                    <input type="number" class="form-control" value="{{ $employee->salary }}">
                    <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                    </div>
                </div>
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
    <div class="card-footer">
        <input type="text" name="employee_id" value="{{ $employee->id }}" hidden>
        <input type="submit" value="حفظ" class="btn btn-primary w-25">
    </div>
    </div>
</form>
@endsection
