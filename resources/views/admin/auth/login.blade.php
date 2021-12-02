<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('dist/img/favico.ico') }}" type="image/ico" sizes="16x16">
    <title>{{ env('APP_NAME') }} | Log in </title>

    @include('admin.layouts.css')

    <style>
        .acube-login-submit-btn {
            position: relative;
            display: inline-block;
            padding: 6px;
            color: #272525;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            overflow: hidden;
            transition: .5s;
            letter-spacing: 4px
        }

        .acube-login-submit-btn:hover {
            background: #272525;
            color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 5px #D49C38,
            0 0 25px #D49C38,
            0 0 50px #D49C38,
            0 0 100px #D49C38;
        }

        .acube-login-submit-btn span {
            position: absolute;
            display: block;
        }

        .acube-login-submit-btn span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #272525);
            animation: btn-anim1 1s linear infinite;
        }

        @keyframes btn-anim1 {
            0% {
                left: -100%;
            }
            50%, 100% {
                left: 100%;
            }
        }

        .acube-login-submit-btn span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #272525);
            animation: btn-anim2 1s linear infinite;
            animation-delay: .25s
        }

        @keyframes btn-anim2 {
            0% {
                top: -100%;
            }
            50%, 100% {
                top: 100%;
            }
        }

        .acube-login-submit-btn span:nth-child(3) {
            bottom: 0;
            right: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(270deg, transparent, #272525);
            animation: btn-anim3 1s linear infinite;
            animation-delay: .5s
        }

        @keyframes btn-anim3 {
            0% {
                right: -100%;
            }
            50%, 100% {
                right: 100%;
            }
        }

        .acube-login-submit-btn span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(360deg, transparent, #272525);
            animation: btn-anim4 1s linear infinite;
            animation-delay: .75s
        }

        @keyframes btn-anim4 {
            0% {
                bottom: -100%;
            }
            50%, 100% {
                bottom: 100%;
            }
        }

        .acube-login-bg-image {
            background-image: url("https://acubepk.com/orbit/public/img/acube-login-bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right;
        }

        .card-primary.card-outline {
            border-top: 3px solid #ffffff;
        }

        .acube-login-box-logo:hover {
            color: #D49C38;
        }
    </style>
</head>

<body class="hold-transition login-page acube-login-bg-image">
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center" style="background-color: #272525;color: #fff">
            <a href="javascript:;" class="h1 acube-login-box-logo">WorkOrBit</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="{{ route('admin.login') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row" style="display: flex;align-items: center;">
                    <div class="col-md-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-block acube-login-submit-btn">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Sign In
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

@include('admin.layouts.js')
</body>

</html>
