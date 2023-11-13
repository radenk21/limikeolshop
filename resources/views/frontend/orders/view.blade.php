@extends('layouts.app')

@section('title', 'Detail Pesanan'. auth()->user()->name)
@section('content')

<div class="py-3 py-md-5">
    <div class="container py-3 py-md-5 shadow bg-white p3">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="mb-4 mx-5">
                        <h4 class="text-primary d-flex justify-content-between">
                            <div class="text-dark">
                                <i class="fa fa-shopping-cart text-dark"></i> Detail Pesanan
                            </div>
                            <a href="{{ route('order.index') }}" class="btn btn-secondary">Kembali</a>
                        </h4>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Detail Pesanan</h5>
                            <hr>
                            <h6>Id pesan: {{ $user_order->id }}</h6>
                            <h6>Id/No Tracking: {{ $user_order->no_tracking }}</h6>
                            <h6>Tanggal Pesanan Dibuat: {{ $user_order->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Jenis Pembayaran: {{ $user_order->payment_mode }}</h6>
                            <h6 class="border p-2 text-success">
                                Status Pesan: <span class="text-uppercase">{{ $user_order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>Detail pengguna</h5>
                            <hr>
                            <h6>Nama lengkap: {{ $user_order->fullname }}</h6>
                            <h6>Email: {{ $user_order->email }}</h6>
                            <h6>Nomor telepon: {{ $user_order->phone }}</h6>
                            <h6>Kode pos: {{ $user_order->pincode }}</h6>
                            <h6>Alamat: {{ $user_order->address }}</h6>
                        </div>
                    </div>

                    <br>
                    <h5>Pesanan</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Id Produk</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                            </thead>
                            <tbody>
                                @foreach ($user_order->orderItem as $orderItem)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $orderItem->id_produk }}</td>
                                        <td>
                                            @if ($orderItem->produk->gambarProduk->count() > 0)
                                                <img src="{{ asset($orderItem->produk->gambarProduk[0]->image) }}" style="width: 100px; height: 100px" alt="{{ $orderItem->produk->name }}">
                                            @else
                                                <img src="" style="width: 100px; height: 100px" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $orderItem->produk->name }}</td>
                                        <td>Rp {{ number_format($orderItem->produk->harga_jual, 0, '.', '.') }} </td>
                                        <td>{{ $orderItem->jumlah }}</td>
                                        <td>Rp {{ number_format($orderItem->harga, 0, '.', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{-- {{ $orders->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection