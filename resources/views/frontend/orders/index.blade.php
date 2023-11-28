@extends('layouts.app')

@section('title', 'Pesanan')
@section('content')

<div class="py-3 py-md-5">
    <div class="container py-3 py-md-5 shadow bg-white p3">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="mb-4">
                        <h1>Pesanan ku</h1>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-light table-striped">
                            <thead class="table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Id Pesan</th>
                                <th class="text-center">Kode Pesanan</th>
                                <th>Username</th>
                                <th>Jenis Pembayaran</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Status Pesan</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                <tr class="">
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{ $order->id }}</td>
                                    <td class="text-center">{{ $order->no_tracking }}</td>
                                    <td>{{ $order->fullname }}</td>
                                    <td>{{ $order->payment_mode }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->status_message }}</td>
                                    <td class="text-center"><a href="{{ route('order.view', $order->id) }}" class="btn btn-primary btn-sm">View</a></td>
                                </tr>
                                @empty
                                    <tr class="none-pesananku">
                                        <td colspan="8" class="text-center align-middle">Belum ada Pesanan yang dibuat, silahkan mencheckout pesanan</td>
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
