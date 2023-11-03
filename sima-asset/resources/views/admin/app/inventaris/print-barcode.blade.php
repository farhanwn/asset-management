<!DOCTYPE html>
<html>

<head>
    <title>QR-CODE {{$inventaris->kode_inventaris}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body text-center">
                <h5 class="card-title"><strong>QR-Code</strong></h5>
                <img src="data:image/png;base64, {{ $qrCode }}">
                <h6 class="card-subtitle mt-2 text-muted">{{$inventaris->kode_inventaris}}</h6>
            </div>
        </div>
    </div>

</body>

</html>