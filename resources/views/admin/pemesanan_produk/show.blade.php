@extends('layouts.admin')

@section('title', 'Detail Pesanan')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-middle">
        <h3>
            Detail Pesanan
        </h3>
        <div class="row">
            <a href="{{ route('AdminOrder.index') }}" class="btn btn-danger">Back</a>
            <div class="d-flex justify-content-between mt-2">
                <a href="{{ route('AdminOrder.invoice-view', $order->id) }}" class="btn btn-warning">Lihat Invoice</a>
                <a href="{{ route('AdminOrder.invoice-download', $order->id) }}" class="btn btn-primary">Download Invoice</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(session('message'))
            <div class="alert alert-success d-flex justify-content-between">
                <div>
                    {{ session('message') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
            @if(session('danger-alert'))
            <div class="alert alert-danger d-flex justify-content-between">
                <div>
                    {{ session('danger-alert') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Detail Pesanan</h5>
                            <hr>
                            <h6>Id pesan: {{ $order->id }}</h6>
                            <h6>Id/No Tracking: {{ $order->no_tracking }}</h6>
                            <h6>Waktu Pesanan Dibuat: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Jenis Pembayaran: {{ $order->payment_mode }}</h6>
                            @if ($order->payment_mode !== 'Cash On Delivery')
                                <h6 class="text-capitalize">Status Pembayaran: {{ $payment->payment_status }}</h6>
                            @endif
                            <h6 class="border p-2 
                                @if ($order->status_message == 'batal')
                                    text-danger
                                @elseif($order->status_message == 'pending')
                                    text-warning
                                @else
                                    text-success
                                @endif
                            ">
                                Status Pesan: <span class="text-uppercase">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>Detail pengguna</h5>
                            <hr>
                            <h6>Nama lengkap: {{ $order->fullname }}</h6>
                            <h6>Email: {{ $order->email }}</h6>
                            <h6>Nomor telepon: {{ $order->phone }}</h6>
                            <h6>Kode pos: {{ $order->pincode }}</h6>
                            <h6>Alamat: {{ $order->address }}</h6>
                        </div>
                    </div>
                    <div class="my-3">
                        <h4>Proses Pesanan (Update Status Pesan)</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <form action="{{ route('AdminOrder.update', $order->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <label for="">Update Status Pesan</label>
                                    <div class="input-group">
                                        <select name="status_message" id="" class="form-select text-capitalize">
                                            <option value="">Pilih Status</option>
                                                @foreach(['terverifikasi', 'belum di verifikasi', 'dalam proses', 'pending', 'selesai', 'batal', 'gagal'] as $status)
                                                    <option {{ $order->status_message == $status ? 'selected' : '' }} value="{{ $status }}">{{ ucfirst($status) }}</option>
                                                @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <br>
                                <h4>
                                    Status pesan sekarang: 
                                    <span class="text-uppercase p-2 rounded
                                    @if ($order->status_message == 'cancelled' || $order->status_message == 'out for delivery')
                                        bg-danger
                                    @elseif($order->status_message == 'pending')
                                        bg-warning
                                    @else
                                        bg-success
                                    @endif
                                    ">
                                        {{ $order->status_message }}
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h5>Pesanan</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-rounded">
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
                                @php
                                    $total_harga_pesanan = 0
                                @endphp
                                @foreach ($order->orderItem as $orderItem)
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
                                        <td class="fw-semibold">Rp {{ number_format($orderItem->harga, 0, '.', '.') }}</td>
                                        @php
                                            $total_harga_pesanan += $orderItem->harga
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        Total harga pesanan
                                    </td>
                                    <td class="fw-semibold">
                                        Rp {{ number_format($total_harga_pesanan, 0, '.', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="py-3 py-md-5">
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
                            <h6>Id pesan: {{ $order->id }}</h6>
                            <h6>Id/No Tracking: {{ $order->no_tracking }}</h6>
                            <h6>Tanggal Pesanan Dibuat: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Jenis Pembayaran: {{ $order->payment_mode }}</h6>
                            <h6 class="border p-2 text-success">
                                Status Pesan: <span class="text-uppercase">{{ $order->status_message }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>Detail pengguna</h5>
                            <hr>
                            <h6>Nama lengkap: {{ $order->fullname }}</h6>
                            <h6>Email: {{ $order->email }}</h6>
                            <h6>Nomor telepon: {{ $order->phone }}</h6>
                            <h6>Kode pos: {{ $order->pincode }}</h6>
                            <h6>Alamat: {{ $order->address }}</h6>
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
                                @php
                                    $total_harga_pesanan = 0
                                @endphp
                                @foreach ($order->orderItem as $orderItem)
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
                                        <td class="fw-semibold">Rp {{ number_format($orderItem->harga, 0, '.', '.') }}</td>
                                        @php
                                            $total_harga_pesanan += $orderItem->harga
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        Total harga pesanan
                                    </td>
                                    <td class="fw-semibold">
                                        Rp {{ number_format($total_harga_pesanan, 0, '.', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection