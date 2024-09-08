@extends('layouts.body_structer')

@section('content_header')
    الشؤون الادارية
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">تعديل بيانات الموظف</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('employee.update', $employee->id) }}" method="POST">
        @csrf
        @method('PUT')
      <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>الاسم الرباعي</label>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="name" type="text" class="form-control" value="{{ $employee->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group mt-2">
                    <label>النوع</label>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select class="custom-select" name="type">
                      <option value="عضو هئية تدريس" {{ $employee->type == 'عضو هئية تدريس' ? 'selected' : '' }}>عضو هئية تدريس</option>
                      <option value="موظف اداري" {{ $employee->type == 'موظف اداري' ? 'selected' : '' }}>موظف اداري</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label>المرتب</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">$</span>
                    </div>
                    <input type="number" min="0" class="form-control" name="salary" value="{{ $employee->salary }}">
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>القسم</label>
                    @error('section_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="section_id" class="mySelect form-control select2" style="width: 100%;">
                        <option>اختر القسم</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ $employee->section_id == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary w-25">حفظ</button>
      </div>
    </form>
  </div>

@endsection


@section('costome_section_scripts')
<script>
    $(document).ready(function() {
      $(".mySelect").change(function() {
        const selectedValue = $(this).val();
        $(".myTextField").prop("disabled", selectedValue !== "ليبي");
      });
    });
    </script>
@endsection
