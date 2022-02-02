<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struck - {{ $transaction->transaction_code }}</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            font-size: 30px;
            font-family: Sans-Serif, serif
        }

        table td, table td * {
            vertical-align: top;
        }

        @page {
            margin: 20px 0;
        }

        p {
            margin: 0;
            padding: 0;
        }

        tr {
            padding: 0;
            margin: 0
        }


        table {
            padding: 0;
            margin: 0
        }

        div {
            padding: 0;
            margin: 0
        }

        .column6 {
            float: left;
            width: 60%;
            padding: 10px;
        }

        .column2 {
            float: left;
            width: 20%;
            padding: 10px;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>
<body>
<div style="text-align: center">
    {{--    <img src="{{ public_path('assets/images/kopi.png') }}" alt="" style="max-height: 50px">--}}
    <img src="{{ public_path('assets/images/leker.png') }}" alt="" style="max-height: 50px">
</div>
<div style="text-align: center;">
    <p>Lekker Putar</p>
    <p></p>
    <p style="font-size: 12px">Jl. Bengawan Solo No.16F Sumbersari, Jember</p>
    <p>----------------------------</p>
</div>


<div style="font-size: 20px;padding: 0">
    <table style="">
        <tr>
            <td>No</td>
            <td>:</td>
            <td>{{ $transaction->transaction_code }}</td>
        </tr>
        <tr>
            <td>Tgl</td>
            <td>:</td>
            <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>:</td>
            <td>{{ $transaction->created_at->format('h:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>:</td>
            <td>{{ $transaction->user->name }}</td>
        </tr>
        <tr>
            <td>Customer</td>
            <td>:</td>
            <td>{{ $transaction->name }}</td>
        </tr>
    </table>
</div>
<div style="font-size: 25px;padding: 0">
    <div>
        <table style="width: 100%;">
            @php($total=0)
            @foreach($transaction->transactionDetails as $td)
                <tr>
                    <td colspan="4">{{ $td->product->title }}</td>
                </tr>
                <tr>
                    <td style="">{{ $td->amount }}</td>
                    <td style="">x</td>
                    <td style="">{{ $td->product->price }}</td>
                    <td style="text-align: right">
                        {{ $td->product->price*$td->amount }}
                        @if($td->product->discount_state)
                            <br>-{{ ($td->product->price-$td->price)*$td->amount }}
                        @endif
                        @php($total+=$td->price*$td->amount)
                    </td>
                </tr>
            @endforeach

        </table>
        <table style="font-size: 20px; width: 100%">
            <tr>
                <td style="text-align: left" colspan="3">
                    <b>TOTAL</b>
                </td>
                <td style="text-align: right">
                    <b>{{ $total }}</b>
                </td>
            </tr>
            <tr>
                <td style="text-align: left" colspan="3">
                    <b>DIBAYAR</b>
                </td>
                <td style="text-align: right">
                    <b>{{ $transaction->fee }}</b>
                </td>
            </tr>
            <tr>
                <td style="text-align: left" colspan="3">
                    <b>KEMBALI</b>
                </td>
                <td style="text-align: right">
                    <b>{{ $transaction->fee-$total }}</b>
                </td>
            </tr>
        </table>
    </div>
</div>
<div style="text-align: center">
    <p>-------------------------------------------</p>
    <p style="font-size: 17px">
        Terima kasih telah membeli produk kami. <br>
        Kami tersedia dalam gofood dan grabfood.<br>
        Kritik dan saran hubungi 081334731184 <br>
        Temukan kami di ig: @lekkerputar
    </p>
</div>
</body>
</html>
