<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset ('login/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset ('login/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset ('login/css/bootstrap.min.css') }}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset ('login/css/style.css') }}">

    <title>Sima Asset RS Bhayangkara</title>
</head>

<body>
    @include('sweetalert::alert')
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('img/BG2.jpg') }}');"></div>
        <div class="contents order-2 order-md-1">

            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" style="width: 5rem">
                        <h3>Selamat Datang di Sistem Management Asset</h3>
                        <h5 class="mb-4">Login to <strong>SIMA-ASET</strong></h5>
                        <form action="{{route('login')}}" method="POST">
                            @csrf
                            <div class="form-group first">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" placeholder="Username Kamu" name="username" id="username">
                            </div>
                            <div class="form-group last mb-5">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Password Kamu" name="password" id="password">
                            </div>
                            <input type="submit" class="btn btn-block btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <script src="{{ asset ('login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset ('login/js/popper.min.js') }}"></script>
    <script src="{{ asset ('login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset ('login/js/main.js') }}"></script>
</body>

</html>