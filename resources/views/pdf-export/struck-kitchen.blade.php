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

<p style="text-align: center">Kitchen Staff</p>
<p>-------------------------------------------</p>
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
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><br><br><br></td>
        </tr>
    </table>
</div>

<div style="font-size: 30px;padding: 0">

    <div>
        <table style="width: 100%;">
            @php($total=0)
            @foreach($transaction->transactionDetails as $td)
                <tr>
                    <td >{{ $td->product->title }}</td>
                    <td style="">{{ $td->amount }}</td>
                </tr>

            @endforeach

        </table>
    </div>
</div>

</body>
</html>
