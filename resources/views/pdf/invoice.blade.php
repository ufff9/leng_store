<!DOCTYPE html>
<html>

<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }

        .info {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }

        .status {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>LENGSTORE - GAMING SHOP</h2>
        <p>Struk Resmi Pembayaran Top Up</p>
    </div>

    <div class="info">
        <p>Tanggal: {{ $transaction->created_at->format('d M Y, H:i') }}</p>
        <p>Nama Pelanggan: {{ $transaction->user->name }}</p>
        <p>WhatsApp: {{ $transaction->whatsapp }}</p>
    </div>

    <table class="table">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Item</th>
                <th>ID Game</th>
                <th>Metode</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaction->product->category->name }} - {{ $transaction->product->amount }}</td>
                <td>{{ $transaction->user_id_game }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>Rp {{ number_format($transaction->product->price) }}</td>
            </tr>
        </tbody>
    </table>

    <p>Status: <span class="status text-uppercase">BERHASIL</span></p>

    <div class="footer">
        <p>Terima kasih telah berbelanja di LENGSTORE!</p>
        <p>Simpan struk ini sebagai bukti pembayaran yang sah.</p>
    </div>
</body>

</html>
