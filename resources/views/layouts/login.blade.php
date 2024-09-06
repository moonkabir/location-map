<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{url('login_assets')}}/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{url('login_assets')}}/css/style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">

                    @yield('content')

                </div>
            </div>
        </div>
    </section>

    <script src="{{url('login_assets')}}/js/jquery.min.js"></script>
    <script src="{{url('login_assets')}}/js/popper.js"></script>
    <script src="{{url('login_assets')}}/js/bootstrap.min.js"></script>
    <script src="{{url('login_assets')}}/js/main.js"></script>

</body>

</html>
