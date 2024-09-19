@extends('layouts.body_structer')

@section('content_header')
    اضافة طالب
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">بيانات الطالب</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('student.store') }}" method="POST">
        @csrf
      <div class="card-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>الاسم الرباعي</label>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>الجنسية</label>
                    @error('nationality')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="nationality" class="mySelect form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <option value="ليبي">ليبي</option>
                        <option value="البحرين">بحريني</option>
                        <option value="جزر القمر">قمري</option>
                        <option value="جيبوتي">جيبوتي</option>
                        <option value="مصر">مصري</option>
                        <option value="العراق">عراقي</option>
                        <option value="الأردن">أردني</option>
                        <option value="الكويت">كويتي</option>
                        <option value="لبنان">لبناني</option>
                        <option value="الجزائر">الجزائر</option>
                        <option value="المغرب">مغربي</option>
                        <option value="موريتانيا">موريتاني</option>
                        <option value="عُمان">عماني</option>
                        <option value="فلسطين">فلسطيني</option>
                        <option value="قطر">قطري</option>
                        <option value="السعودية">سعودي</option>
                        <option value="الصومال">صومالي</option>
                        <option value="السودان">سوداني</option>
                        <option value="سوريا">سوري</option>
                        <option value="تونس">تونسي</option>
                        <option value="الإمارات العربية المتحدة">إماراتي</option>
                        <option value="اليمن">يمني</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="phone" type="text" class="form-control" placeholder="09X-XXXXXXX" value="{{ old('phone') }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>الرقم الوطني</label>
                    @error('nationla_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="nationla_id" type="text" class="myTextField form-control" value="{{ old('nationla_id') }}">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label>القسم</label>
                    @error('section_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="section_id" class="form-control select2" style="width: 100%;">
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-6">
                <label>الجنس</label>
                @error('gender')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <select name="gender" class="form-control">
                    <option value="ذكر">ذكر</option>
                    <option value="انثى">انثى</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label>صفة القيد</label>
                @error('attendance_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                <select name="attendance_type" class="form-control">
                    <option value="نظامي">نظامي</option>
                    <option value="انتساب">انتساب</option>
                </select>
            </div>
            <div class="col-sm-6">
                <div class="form-group mt-2">
                    <label>رقم القيد</label>
                    @error('st_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="text" name="st_id" class="form-control" value="{{ old('st_id') }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>رقم هاتف ولي الامر</label>
                    @error('perant_phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="perant_phone" type="text" class="form-control" placeholder="09X-XXXXXXX" value="{{ old('perant_phone') }}">
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
