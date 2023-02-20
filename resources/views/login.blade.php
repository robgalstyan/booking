<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        .main-div {
            padding-top: 300px;
        }

        form>div{
            margin:  auto;
        }
    </style>
</head>
<body>
<div class="main-div">
    @if(session('success'))
        <div class="alert offset-md-4 col-md-4 alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{url('/login')}}">
        @csrf
        @if(session('login_error'))
            <div class="form-group col-md-4 has-error alert alert-danger">{{session('login_error')}}</div>
        @endif

        @if($errors->has('email'))
            <div class="has-error alert alert-danger form-group col-md-4">{{ $errors->first('email') }}</div>
        @endif
        @if($errors->has('password'))
            <div class="has-error alert alert-danger form-group col-md-4">{{ $errors->first('password') }}</div>
        @endif

        <div class="form-group col-md-4">
            <label for="log-email">Login</label>
            <input name="email" type="email" class="form-control" id="log-email" value="@if(session('error_email')) {{session('error_email')}} @else {{old('email')}} @endif">
        </div>
        <div class="form-group col-md-4">
            <label for="log-pass">Password</label>
            <input name="password" type="password" class="form-control" id="log-pass">
        </div>
        <div class="form-group col-md-4">
            <button type="submit" class="btn btn-success">Sign In</button>
            <a href="{{ url('register') }}" class="float-right">Go To Register</a>
        </div>
    </form>
</div>

</body>
</html>
