<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>عالم الابتكار</title>
    @include('includes.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        عالم <b>الابتكار</b>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">تسجيل دخول الطالب</p>
            @if (Session::has('login_error'))
                <div class="alert alert-danger text-center">{{ session('login_error') }}</div>
            @endif
          <form action="{{ route('student_login') }}" method="post">
            @csrf
            @error('username')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
              <input name="st_id" type="text" class="form-control" placeholder="رقم القيد">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            @error('phone')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="input-group mb-3">
              <input name="phone" type="text" class="form-control" placeholder="09X-XXXXXXX">
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
