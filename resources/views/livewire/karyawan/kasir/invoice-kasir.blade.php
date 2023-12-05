<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Pembelian</title>
</head>
<body>
    <script>
        window.onload = function () {
            // Buka tab baru saat halaman dimuat
            window.open('', '_blank');
            // Lakukan pengalihan ke rute yang sesuai
            window.location.href = '{{ route("nama_rute") }}';
        }
    </script>
    
    <div style="width: 300px; font-family: Arial; font-size: 12px;">
        <h3 style="text-align: center;">LIMIKE OLSHOP</h3>
        <h3 style="text-align: center;">Faktur Pembelian</h3>
        <p style="text-align: right;">Tanggal: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
        <table style="width:100%;border-collapse:collapse;border:1px solid black;">
            <tr>
                <th style="border:1px solid black;padding:8px;">Nama Barang</th>
                <th style="border:1px solid black;padding:8px;">Harga Satuan</th>
                <th style="border:1px solid black;padding:8px;">Jumlah</th>
                <th style="border:1px solid black;padding:8px;">Subtotal</th>
            </tr>
            @foreach ($order->orderItem as $orderItem)
                <tr>
                    <td style="border:1px solid black;padding:8px;">{{ $orderItem->produk->name }}</td>
                    <td style="border:1px solid black;padding:8px;">{{ $orderItem->produk->harga_jual }}</td>
                    <td style="border:1px solid black;padding:8px;">{{ $orderItem->jumlah }}</td>
                    <td style="border:1px solid black;padding:8px;">{{ $orderItem->harga }}</td>
                </tr>
            @endforeach
        </table>
        <h2 style="text-align: right; margin-top: 10px;">Total: {{ $order->total_harga }}</h2>
    </div>
    <script>
        async function printToThermalPrinter(content) {
            try {
                const port = await navigator.serial.requestPort();
                await port.open({ baudRate: 1200 }); 
                
                const writer = port.writable.getWriter();
                await writer.write(new TextEncoder().encode(content));
                await writer.releaseLock();

                await port.close();
            } catch (error) {
                console.error('Error printing:', error);
            }
        }
    </script>
</body>
</html>