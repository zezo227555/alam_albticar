@extends('layouts.body_structer')

@section('content_header')
    تعديل بيانات طالب
@endsection

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">بيانات الطالب</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ route('student.update', $student->id) }}" method="POST">
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
                    <input name="name" type="text" class="form-control" value="{{ $student->name }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>الجنسية</label>
                    @error('nationality')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <select name="nationality" class="mySelect form-control select2 select2-hidden-accessible" style="width: 100%;">
                        <option>اختر الجنسية</option>
                        <option {{ $student->nationality == 'ليبي' ? 'selected' : '' }} value="ليبي">ليبي</option>
                        <option {{ $student->nationality == 'البحرين' ? 'selected' : '' }} value="البحرين">بحريني</option>
                        <option {{ $student->nationality == 'جزر القمر' ? 'selected' : '' }} value="جزر القمر">قمري</option>
                        <option {{ $student->nationality == 'جيبوتي' ? 'selected' : '' }} value="جيبوتي">جيبوتي</option>
                        <option {{ $student->nationality == 'مصر' ? 'selected' : '' }} value="مصر">مصري</option>
                        <option {{ $student->nationality == 'العراق' ? 'selected' : '' }} value="العراق">عراقي</option>
                        <option {{ $student->nationality == 'الأردن' ? 'selected' : '' }} value="الأردن">أردني</option>
                        <option {{ $student->nationality == 'الكويت' ? 'selected' : '' }} value="الكويت">كويتي</option>
                        <option {{ $student->nationality == 'لبنان' ? 'selected' : '' }} value="لبنان">لبناني</option>
                        <option {{ $student->nationality == 'الجزائر' ? 'selected' : '' }} value="الجزائر">الجزائر</option>
                        <option {{ $student->nationality == 'المغرب' ? 'selected' : '' }} value="المغرب">مغربي</option>
                        <option {{ $student->nationality == 'موريتانيا' ? 'selected' : '' }} value="موريتانيا">موريتاني</option>
                        <option {{ $student->nationality == 'عُمان' ? 'selected' : '' }} value="عُمان">عماني</option>
                        <option {{ $student->nationality == 'فلسطين' ? 'selected' : '' }} value="فلسطين">فلسطيني</option>
                        <option {{ $student->nationality == 'قطر' ? 'selected' : '' }} value="قطر">قطري</option>
                        <option {{ $student->nationality == 'السعودية' ? 'selected' : '' }} value="السعودية">سعودي</option>
                        <option {{ $student->nationality == 'الصومال' ? 'selected' : '' }} value="الصومال">صومالي</option>
                        <option {{ $student->nationality == 'السودان' ? 'selected' : '' }} value="السودان">سوداني</option>
                        <option {{ $student->nationality == 'سوريا' ? 'selected' : '' }} value="سوريا">سوري</option>
                        <option {{ $student->nationality == 'تونس' ? 'selected' : '' }} value="تونس">تونسي</option>
                        <option {{ $student->nationality == 'الإمارات العربية المتحدة' ? 'selected' : '' }} value="الإمارات العربية المتحدة">إماراتي</option>
                        <option {{ $student->nationality == 'اليمن' ? 'selected' : '' }} value="اليمن">يمني</option>
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
                    <input name="phone" type="text" class="form-control" placeholder="09X-XXXXXXX" value="{{ $student->phone }}">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label>الرقم الوطني</label>
                    @error('nationla_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="nationla_id" type="text" class="myTextField form-control" value="{{ $student->nationla_id }}">
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
                    <select name="section_id" class="mySelect form-control select2" style="width: 100%;">
                        <option>اختر القسم</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}" {{ $section->id == $student->section_id ? 'selected' : '' }}>{{ $section->name }}</option>
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
                    <option>اختر الجنس</option>
                    <option value="ذكر" {{ $student->gender == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                    <option value="انثى" {{ $student->gender == 'انثى' ? 'selected' : '' }}>انثى</option>
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
                    <option value="نظامي" {{ $student->gender == 'نظامي' ? 'selcted' : '' }}>نظامي</option>
                    <option value="انتساب" {{ $student->gender == 'انتساب' ? 'selcted' : '' }}>انتساب</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>رقم هاتف ولي الامر</label>
                    @error('perant_phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="perant_phone" type="text" class="form-control" placeholder="09X-XXXXXXX" value="{{ $sudent->perant_phone }}">
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
