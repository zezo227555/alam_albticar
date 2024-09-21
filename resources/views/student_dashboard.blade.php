@extends('layouts.student_body_structer')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-4">
            @if (session('student')->section->level == 'عالي')
                <img src="{{ asset('images/logo_hige.svg') }}" alt="LOGO" width="250" height="250">
            @else
                <img src="{{ asset('images/logo_low.svg') }}" alt="LOGO" width="250" height="250">
            @endif
        </div>
    </div>
</div>

@endsection
