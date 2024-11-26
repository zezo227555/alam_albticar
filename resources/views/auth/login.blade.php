<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>منظومة الدراسة و الامتحانات</title>
    @include('includes.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box text-center">
      <div class="login-logo">
        <img src="{{ asset('images/logo_hige.svg') }}" alt="LOGO" width="100" height="100">
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">اهلا بك</p>
            @if (Session::has('login_error'))
                <div class="alert alert-danger text-center">{{ session('login_error') }}</div>
            @endif
          <form action="{{ route('loging') }}" method="post">
            @csrf
            @error('username')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
              <input name="username" type="text" class="form-control" placeholder="اسم المستخدم">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('password')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
              <input name="password" type="password" class="form-control" placeholder="كلمة المرور">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">تسجيل الدخول</button>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
    </body>

    @include('includes.foot')
</html>
