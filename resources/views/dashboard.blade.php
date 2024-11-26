@extends('layouts.body_structer')

@section('content')
    <div class="row px-5">
        <div class="col-sm-12">
            <div class="card card-widget widget-user h-100">
                <div class="widget-user-header bg-primary">
                    <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                    <h5 class="widget-user-desc">مرحبا بك</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2 h-100" src="{{ asset('images/high.jpg') }}" alt="Logo">
                </div>
                <div class="card-footer h-100">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $season->name }} {{ $season->created_at->format('Y') }}
                                </h5>
                                <span class="description-text">الفصل الحالي</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ count($sections) }}</h5>
                                <span class="description-text">عدد الاقسام</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{ count($teachers) }}</h5>
                                <span class="description-text">عدد المدرسين</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('costome_section_scripts')
    <script src="{{ asset('plugins/daterangepiker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/daterangepiker/moment.min.js') }}"></script>
@endsection
