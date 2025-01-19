@extends('layouts.body_structer')

@section('content_header')
    الاعدادات
@endsection

@section('content')

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">الفصل الدراسي </h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('settings_season_new') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>اختر الفصل الدراسي</label>
                <select class="form-control" name="name">
                    <option value="ربيع">ربيع {{ Carbon\Carbon::now()->format('Y') }}</option>
                    <option value="صيف">صيف {{ Carbon\Carbon::now()->format('Y') }}</option>
                    <option value="خريف">خريف {{ Carbon\Carbon::now()->format('Y') }}</option>
                </select>
            </div>
              <input type="submit" value="حفظ" class="btn btn-primary w-25">
        </form>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">اغلاق الفصل الدراسي</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <form action="{{ route('settings_season_close') }}" method="POST">
            @csrf
            @if (isset($season))
                <div class="alert alert-secondary">{{ $season->name }} {{ $season->created_at->format('Y') }}</div>
            @else
                <div class="alert alert-secondary">تم اغلاق اخر فصل ({{ $last_season->name }} {{ $last_season->created_at->format('Y') }})</div>
            @endif
            @isset($season)
                <input type="text" name="season_id" value="{{ $season->id }}" hidden>
            @endisset
            <input type="submit" value="اغلاق الفصل الدراسي" class="btn btn-primary close_season">
          </form>
        </div>
      </div>
  </div>
</div>

@endsection


@section('costome_section_scripts')
    <script>
        $('.close_season').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل انت متأكد من أنك ترغب اغلاق الفصل الدراسي ؟',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم',
            cancelButtonText: 'الغاء'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endsection


