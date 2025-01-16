<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>عالم الابتكار</title>
    @include('includes.head')
    <style>
        .rtl {
            direction: rtl;
        }

        .input-group-text {
            border-top-left-radius: .3rem !important;
            border-bottom-left-radius: .3rem !important;
        }

        .form-control {
            border-top-right-radius: .3rem !important;
            border-bottom-right-radius: .3rem !important;

            border-top-left-radius: 0 !important;
            border-bottom-left-radius: 0 !important;
        }
    </style>
</head>

<body class="login-page bg-body-secondary app-loaded">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('images/logo_hige.svg') }}" alt="LOGO" width="100" height="100">
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h1 class="mb-1">عالم الابتكار</h1>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">سجل دخولك لتبدأ</p>
                @if (Session::has('login_error'))
                    <div class="alert alert-danger text-center">{{ session('login_error') }}</div>
                @endif
                <form action="{{ route('loging') }}" method="post">
                    @csrf
                    @error('username')
                        <p class="text-danger rtl">{{ $message }}</p>
                    @enderror
                    <div class="input-group mb-2">
                        <div class="input-group-text">
                            <span class="bi bi-person-fill"></span>
                        </div>
                        <div class="form-floating">
                            <input type="text" name="username" class="form-control rtl" value=""
                                placeholder="">
                            <label class="rtl">اسم المستخدم</label>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-danger rtl">{{ $message }}</p>
                    @enderror
                    <div class="input-group">
                        <div class="input-group-text">
                            <span class="bi bi-lock-fill"></span>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control rtl" placeholder="">
                            <label class="rtl">كلمة المرور</label>
                        </div>
                    </div>
                    <input type="submit" value="تسجيل الدخول" class="btn btn-primary w-100 mt-4">
                </form>
            </div>
        </div>
    </div>
</body>

@include('includes.foot')

</html>
