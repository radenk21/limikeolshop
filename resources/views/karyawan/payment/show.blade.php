@extends('layouts.admin')

@section('title', 'Detail Pembayaran')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-middle">
        <h3>
            Detail Pembayaran
        </h3>
        <div class="row">
            <a href="{{ route('AdminPayment.index') }}" class="btn btn-danger">Back</a>
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
                            <h5>Detail Pembayaran</h5>
                            <hr>
                            <h6>Id pesan: {{ $payment->order->id }}</h6>
                            <h6>Id/No Tracking: {{ $payment->order->no_tracking }}</h6>
                            <h6>Waktu Pembayaran Dibuat: {{ $payment->created_at->format('d-m-Y h:i A') }}</h6>
                            <h6>Jenis Pembayaran: {{ $payment->order->payment_mode }}</h6>
                            <h6>Nomor Rekening: {{ $payment->no_rekening }}</h6>
                            <h6>Total harga dibayar: Rp {{ number_format($payment->total_bayar, 0, '.', '.') }}</h6>
                            <h6 class="border p-2 
                                @if ($payment->payment_status == 'batal' || $payment->payment_status == 'gagal')
                                    text-danger
                                @elseif($payment->payment_status == 'belum di verifikasi')
                                    text-warning
                                @else
                                    text-success
                                @endif
                            ">
                                Status Pesan: <span class="text-uppercase">{{ $payment->payment_status }}</span>
                            </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>Detail pengguna</h5>
                            <hr>
                            <h6>Nama lengkap: {{ $payment->user->name }}</h6>
                            <h6>Email: {{ $payment->user->email }}</h6>
                            <h6>Nomor telepon: {{ $payment->order->phone }}</h6>
                            <h6>Kode pos: {{ $payment->order->pincode }}</h6>
                            <h6>Alamat: {{ $payment->order->address }}</h6>
                        </div>
                    </div>
                    <div class="my-3">
                        <h4>Proses Pembayaran (Update Status Pembayaran)</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-5">
                                <form action="{{ route('AdminPayment.update', $payment->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <label for="">Update Status Pesan</label>
                                    <div class="input-group">
                                        <select name="payment_status" id="" class="form-select">
                                            <option value="">Pilih Status</option>
                                            @foreach(['belum di verifikasi', 'terverifikasi', 'gagal', 'batal'] as $status)
                                                <option {{ $payment->payment_status == $status ? 'selected' : '' }} value="{{ $status }}">{{ ucfirst($status) }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <br>
                                <h4>
                                    Status pembayaran sekarang: 
                                    <span class="text-uppercase p-2 rounded
                                    @if ($payment->payment_status == 'batal' || $payment->payment_status == 'gagal')
                                        bg-danger
                                    @elseif($payment->payment_status == 'belum di verifikasi')
                                        bg-warning
                                    @else
                                        bg-success
                                    @endif
                                    ">
                                        {{ $payment->payment_status }}
                                    </span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <h5>Pembayaran</h5>
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
                                    $total_harga_Pembayaran = 0
                                @endphp
                                @foreach ($payment->order->orderItem as $paymentItem)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $paymentItem->id_produk }}</td>
                                        <td>
                                            @if ($paymentItem->produk->gambarProduk->count() > 0)
                                                <img src="{{ asset($paymentItem->produk->gambarProduk[0]->image) }}" style="width: 100px; height: 100px" alt="{{ $paymentItem->produk->name }}">
                                            @else
                                                <img src="" style="width: 100px; height: 100px" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $paymentItem->produk->name }}</td>
                                        <td>Rp {{ number_format($paymentItem->produk->harga_jual, 0, '.', '.') }} </td>
                                        <td>{{ $paymentItem->jumlah }}</td>
                                        <td class="fw-semibold">Rp {{ number_format($paymentItem->harga, 0, '.', '.') }}</td>
                                        @php
                                            $total_harga_Pembayaran += $paymentItem->harga
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6">
                                        Total harga Pembayaran
                                    </td>
                                    <td class="fw-semibold">
                                        Rp {{ number_format($total_harga_Pembayaran, 0, '.', '.') }}
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

@endsection