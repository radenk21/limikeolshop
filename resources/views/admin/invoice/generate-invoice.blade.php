<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr>
                <th width="50%" colspan="2">
                    <h2 class="text-start">Limike Olshop</h2>
                </th>
                <th width="50%" colspan="2" class="text-end company-data">
                    <span>Invoice Id: #{{ $order->id }}</span> <br>
                    <span>Waktu: {{ $order->created_at }}</span> <br>
                    <span>Kode Pos: 20147</span> <br>
                    <span>Alamat: Jl. Panca Karya No.84c, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera Utara 20147</span> <br>
                </th>
            </tr>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Detail Pesan</th>
                <th width="50%" colspan="2">Detail Pengguna</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Id Pesan:</td>
                <td>{{ $order->id }}</td>

                <td>Nama Lengkap:</td>
                <td>{{ $order->fullname }}</td>
            </tr>
            <tr>
                <td>Id/No. Tracking:</td>
                <td>{{ $order->no_tracking }}</td>

                <td>Email:</td>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <td>Waktu pemesanan:</td>
                <td>{{ $order->created_at }}</td>

                <td>Nomor telepon:</td>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <td>Jenis Pembayaran:</td>
                <td>{{ $order->payment_mode }}</td>

                <td>Alamat:</td>
                <td>{{ $order->address }}</td>
            </tr>
            <tr>
                <td>Status Pesan:</td>
                <td>{{ $order->status_message }}</td>

                <td>Kode Pos:</td>
                <td>{{ $order->pincode }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>No</th>
                <th>ID</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_harga_pesanan = 0
            @endphp
            @foreach ($order->orderItem as $orderItem)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $orderItem->id_produk }}</td>
                    <td>{{ $orderItem->produk->name }}</td>
                    <td>Rp {{ number_format($orderItem->produk->harga_jual, 0, '.', '.') }} </td>
                    <td>{{ $orderItem->jumlah }}</td>
                    <td class="fw-semibold">Rp {{ number_format($orderItem->harga, 0, '.', '.') }}</td>
                    @php
                        $total_harga_pesanan += $orderItem->harga
                    @endphp
                </tr>
            @endforeach
            <tr>
                <td colspan="5">
                    Total harga pesanan
                </td>
                <td class="fw-semibold">
                    Rp {{ number_format($total_harga_pesanan, 0, '.', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <p class="text-center">
        Terima kasih telah berbelanja di Limike Olshop
    </p>

</body>
</html>