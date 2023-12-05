@extends('layouts.app')

@section('title', 'Detail Pesanan')
@section('content')

<div class="py-3 py-md-5">
    <div class="container py-3 py-md-5 shadow bg-white p3">
        <div class="detail-pesanan-order">
            <div class="mb-4 mx-5">
                <h4 class="text-primary d-flex justify-content-between">
                    <div class="text-dark">
                        <i class="fa fa-shopping-cart text-dark"></i> Detail Pesanan
                    </div>
                    <a href="{{ route('order.index') }}" class="btn btn-primary">Kembali</a>
                </h4>
            <div class="detail-pesanan-content">

                <div class="details">
                    <div class="detail-pesanan">
                        <div class="data">
                            <h5>Detail Pesanan <i class="font-weight-bolder"> #{{ $user_order->no_tracking }}</i></h5>
                            <hr>
                            <h6 class="pesanan-text"><i>Id pesan</i> <i class="i-lefter">{{ $user_order->id }}</i></h6>
                            <h6 class="pesanan-text"><i>Id/No Tracking</i><i class="i-lefter"> {{ $user_order->no_tracking }}</i></h6>
                            <h6 class="pesanan-text"><i>Tanggal Pesanan Dibuat</i><i class="i-lefter"> {{ $user_order->created_at->format('d-m-Y h:i A') }}</i></h6>
                            <h6 class="pesanan-text"><i>Jenis Pembayaran</i><i class="i-lefter"> {{ $user_order->payment_mode }}</i></h6>
                        </div>
                        <h6 class="text-success1 bg-primary">
                            <span class="text-uppercase">{{ $user_order->status_message }}</span>
                        </h6>
                    </div>
                    <div class="detail-pengguna">
                        <div class="data-pengguna">
                            <h5>Detail pengguna</h5>
                            <hr>
                            <h6 class="pesanan-text"><i>Nama lengkap</i> <i class="i-lefter">{{ $user_order->fullname }}</i></h6>
                            <h6 class="pesanan-text"><i>Email</i> <i class="i-lefter">{{ $user_order->email }}</i></h6>
                            <h6 class="pesanan-text"><i>Nomor telepon</i> <i class="i-lefter">{{ $user_order->phone }}</i></h6>
                            <h6 class="pesanan-text"><i>Kode pos</i> <i class="i-lefter">{{ $user_order->pincode }}</i></h6>
                            <h6 class="pesanan-text"><i>Alamat</i> <i class="i-lefter">{{ $user_order->address }}</i></h6>
                        </div>
                    </div>
                </div>

                <div class="list-order">
                    <div class="table-responsive">
                        <table class="table table-light table-striped table-radius">
                            <thead class="table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Id Produk</th>
                                <th>Gambar</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                            </thead>
                            <tbody>
                                @php
                                    $total_harga_pesanan = 0
                                @endphp
                                @foreach ($user_order->orderItem as $orderItem)
                                    <tr>
                                        <td class="align-middle text-center">{{ $loop->index + 1 }}</td>
                                        <td class="align-middle text-center">{{ $orderItem->id_produk }}</td>
                                        <td>
                                            @if ($orderItem->produk->gambarProduk->count() > 0)
                                                <img src="{{ asset($orderItem->produk->gambarProduk[0]->image) }}" style="width: 100px; height: 100px" alt="{{ $orderItem->produk->name }}">
                                            @else
                                                <img src="" style="width: 100px; height: 100px" alt="">
                                            @endif
                                        </td>
                                        <td class="align-middle">{{ $orderItem->produk->name }}</td>
                                        <td class="align-middle">Rp {{ number_format($orderItem->produk->harga_jual, 0, '.', '.') }} </td>
                                        <td class="align-middle">{{ $orderItem->jumlah }}</td>
                                        <td class="fw-semibold align-middle">Rp {{ number_format($orderItem->harga, 0, '.', '.') }}</td>
                                        @php
                                            $total_harga_pesanan += $orderItem->harga
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="total-order-table"></td>
                                    <td colspan="5" class="align-middle">
                                        <h6> <b>Total harga pesanan</b></h6>
                                    </td>
                                    <td class="fw-bolder align-middle">
                                        <h5>Rp {{ number_format($total_harga_pesanan, 0, '.', '.') }}</h5>
                                    </td>
                                </tr>
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
