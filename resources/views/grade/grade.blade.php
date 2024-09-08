@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content_action')
    <a href="{{ route('grade.create_grade_sheet', $student->id) }}" class="btn btn-primary">انشاء كشف درجات للطالب</a>
@endsection

@section('content')
<form action="{{ route('grade.update_grade_sheet') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">كشف درجات الطالب <span class="btn btn-secondary">{{ $student->name }}</span></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-striped text-center w-100" id="datatable">
                <thead>
                <tr>
                  <th>المادة</th>
                  <th>الدرجة</th>
                  <th>النتيجة</th>
                  <th>تاريخ اخر تعديل</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td>{{ $grade->course->name }}</td>
                            <td>
                                <input type="number" name="resault[{{ $grade->id }}]" value="{{ $grade->resault }}" min="0" max="100">
                            </td>
                            <td>
                                @if ($grade->resault >= 50)
                                    <span class="btn btn-success">ناجح</span>
                                @else
                                    <span class="btn btn-danger">راسب</span>
                                @endif
                            </td>
                            <td>{{ $grade->updated_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <input type="submit" value="حفظ" class="btn btn-primary w-25">
        </div>
    </div>
</form>
@endsection




