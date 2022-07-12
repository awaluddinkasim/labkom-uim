<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Admin | {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <style>
        body {
            min-height: 100vh;
        }

        .card.card-login {
            min-width: 75%;
            margin: 20px 0px;
        }

        .logo {
            height: 200px;
        }

        .w-70 {
            width: 70% !important;
        }
    </style>
</head>

<body class="bg-primary d-flex justify-content-center align-items-center">

    <div class="card card-login">
        <div class="card-body px-5 py-4">
            <div class="row">
                <div class="col-lg-8 d-none d-lg-flex justify-content-center">
                    <img src="{{ asset('assets/img/admin.svg') }}" alt="img" class="w-70">
                </div>
                <div class="col-lg-4 py-3">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="" class="logo">
                    </div>
                    <form method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" autocomplete="off"
                                autofocus required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember" name="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.js') }}"></script>
</body>

</html>
