@extends('layouts.body_structer')

@section('content_header')
    شؤون الطلبة
@endsection

@section('content_action')
    <form action="{{ route('grade.create_grade_sheet') }}" method="GET">
        @csrf
        <input type="text" name="student_id" value="{{ $student->id }}" hidden>
        <input type="text" name="season_id" value="{{ $season->id }}" hidden>
        <button role="submit" class="btn btn-primary">انشاء كشف درجات <i class="fa-regular fa-folder-open"></i></button>
    </form>
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
                            <th>ر.م</th>
                            <th>المادة</th>
                            <th>اعمال السنة</th>
                            <th>النهائي</th>
                            <th>النتيجة</th>
                            <th>المجموع</th>
                            <th>تاريخ اخر تعديل</th>
                            <th>اخر تعديل بواسطة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $co = 1;
                        @endphp
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $co }}</td>
                                <td>{{ $grade->course->name }}</td>
                                <td>
                                    <input class="form-control d-inline" type="number"
                                        name="semester_work[{{ $grade->id }}]" value="{{ $grade->semester_work }}"
                                        min="0" max="40">
                                </td>
                                <td>
                                    <input class="form-control d-inline" type="number" name="final[{{ $grade->id }}]"
                                        value="{{ $grade->final }}" min="0" max="60">
                                </td>
                                <td>{{ $grade->total }}</td>
                                <td>
                                    @if ($grade->semester_work + $grade->final >= 50)
                                        <span class="btn btn-success">ناجح <i class="fa-solid fa-check"></i></span>
                                    @else
                                        <span class="btn btn-danger">راسب <i class="fa-solid fa-xmark"></i></span>
                                    @endif
                                </td>
                                <td>{{ $grade->updated_at->format('Y/m/d') }}</td>
                                <td>{{ $grade->user->username }}</td>
                            </tr>
                            @php
                                $co++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <button role="submit" class="btn btn-primary w-25">حفظ <i class="fa-solid fa-floppy-disk"></i></button>
            </div>
        </div>
    </form>
@endsection
