@extends('layouts.app')

@section('title', 'Pesanan'. auth()->user()->name)
@section('content')

<div class="py-3 py-md-5">
    <div class="container py-3 py-md-5 shadow bg-white p3">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="mb-4">
                        Pesanan ku
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <th>No</th>
                                <th>Id Pesan</th>
                                <th>Nomor Pesanan</th>
                                <th>Username</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status Pesan</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td>{{ $order->no_tracking }}</td>
                                    <td>{{ $order->fullname }}</td>
                                    <td>{{ $order->payment_mode }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->status_message }}</td>
                                    <td><a href="{{ route('order.view', $order->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">Belum ada Pesanan yang dibuat, silahkan mencheckout pesanan</td>
                                    </tr>
                                @endforelse
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
</div>

@endsection