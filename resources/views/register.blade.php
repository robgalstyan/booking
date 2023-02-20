<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="main-div">
    <h1 class="register-text">Register</h1>
    <form method="POST" action="{{url('/register')}}">
        @csrf

        @if($errors->has('first_name'))
            <div class="has-error alert alert-danger form-group col-md-4">{{ $errors->first('first_name') }}</div>
        @endif
        @if($errors->has('last_name'))
            <div class="has-error alert alert-danger form-group col-md-4">{{ $errors->first('last_name') }}</div>
        @endif
        @if($errors->has('email'))
            <div class="has-error alert alert-danger form-group col-md-4">{{ $errors->first('email') }}</div>
        @endif
        @if($errors->has('password'))
            <div class="has-error alert alert-danger form-group col-md-4">{{ $errors->first('password') }}</div>
        @endif

        <div class="form-group col-md-4">
            <label for="register-first-name">First Name</label>
            <input id="register-first-name" name="first_name" type="text" class="form-control" value="@if(session('error_first_name')) {{session('error_first_name')}} @else {{old('first_name')}} @endif">
        </div>


        <div class="form-group col-md-4">
            <label for="register-last-name">Last Name</label>
            <input id="register-last-name" name="last_name" type="text" class="form-control" value="@if(session('error_last_name')) {{session('error_last_name')}} @else {{old('last_name')}} @endif">
        </div>


        <div class="form-group col-md-4">
            <label for="register-email">Email</label>
            <input id="register-email" name="email" type="text" class="form-control" value="@if(session('error_email')) {{session('error_email')}} @else {{old('email')}} @endif">
        </div>


        <div class="form-group col-md-4">
            <label for="register-pass">Password</label>
            <input name="password" type="password" class="form-control" id="register-pass">
        </div>
        <div class="form-group col-md-4" style="justify-content: space-around">
            <a href="{{ url('login') }}">Go To Login</a>
            <button type="submit" class="btn btn-secondary float-right">Sign Up</button>
        </div>
    </form>
</div>

</body>
</html>
