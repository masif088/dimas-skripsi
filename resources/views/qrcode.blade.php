<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>How to Generate QR Code in Laravel 8</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body>

<div class="container mt-4">

    <div class="row">
        @foreach($listOfTable as $index=>$qr)
            <div class="col-6">
                <div style="position: page; top: 10px">
                    <h2>{{ $qr }}</h2>
                </div>
                <div>
                    {!! QrCode::size(260)->generate('https://cafe.imajisociopreneur.com/self-transaction/'.$qr) !!}
                </div>
            </div>

        @endforeach
    </div>
    @foreach($listOfTable as $index=>$qr)
        {{ $qr }}<br>
        {{ 'https://cafe.imajisociopreneur.com/self-transaction/'.base64_encode($qr) }} <br>

    @endforeach

</div>
</body>
</html>