<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: black;
        }
        .title-row {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Laporan Pembayaran</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Order ID</th>
                <th>Nama Customer</th>
                <th>No Telp</th>
                <th>Alamat 1</th>
                <th>Alamat 2</th>
                <th>Alamat 3</th>
                <th>Tanggal Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $index => $payment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $payment->order_id }}</td>
                    <td>{{ $payment->name }}</td>
                    <td>{{ $payment->phone }}</td>
                    <td>{{ $payment->address1 }}</td>
                    <td>{{ $payment->address2 }}</td>
                    <td>{{ $payment->address3 }}</td>
                    <td>{{ $payment->payment_date }}</td>
                    <td>{{ $payment->payment_method }}</td>
                    <td>{{ number_format($payment->amount, 0) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
