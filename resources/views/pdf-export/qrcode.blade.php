@php use Carbon\Carbon; @endphp
        <!DOCTYPE html>
<html lang="en" style="margin: 0;padding: 0">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @page {
            margin: 0;
        }

        table, th, td {
            border-collapse: collapse;
        }

        .table table, .table th, .table td {
            border-collapse: collapse;
            border: .5px solid black;
        }
        .page_break { page-break-before: always; }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<main style="width:100%;padding: 0 0">
    @foreach($listOfTable as $index=>$qr)
        <div>
            <img src="{{ public_path('assets/self-transaction.png') }}" style="width: 100%;position: absolute" alt="">
            <div style="z-index: 100; left: 15px; padding-top: 35px; position: absolute; font-size: 70px; color: white">
                {{ $listOfCode[$index] }}
            </div>
            <div style="z-index: 99; text-align: center; padding-top: 250px;">
                <img src="data:image/png;base64,{{ base64_encode(QrCode::format('svg')->size(450)->errorCorrection('H')->generate('https://cafe.imajisociopreneur.com/self-transaction/'.base64_encode($qr))) }}"/>
            </div>
            <div style="text-align: center;z-index: 99;">
                <h2 style="font-size: 40px">bit.ly/ics-{{ $listOfCode[$index] }}</h2>
            </div>


        </div>
        <div class="page_break"></div>
    @endforeach
</main>
</body>
</html>
