@extends('layouts.admin')
@section('title', 'Daftar Pesanan')
@section('content')
<div>
    @if(session('message'))
        <div class="alert alert-success d-flex justify-content-between">
            <div>
                {{ session('message') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Delete
    </button> --}}
    
    <!-- Modal -->
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Daftar Pesanan
            </h3>
        </div>
        <div class="card-body">
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <h4>Urutkan Berdasarkan Tanggal</h4>
                            <div class="col-md-5">
                                <label for="">Awal Tanggal</label>
                                <input type="date" name="awalDate" value="null" id="" class="form-control">
                            </div>
                            <div class="col-md-5">
                                <label for="">Akhir Tanggal</label>
                                <input type="date" name="akhirDate" value="null" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 mt-3">
                        <h4>Urutkan Berdasarkan Status</h4>
                        <label for="">Pilih Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="">Pilih Status</option>
                            @foreach(['terverifikasi', 'belum di verifikasi', 'dalam proses', 'pending', 'selesai', 'batal', 'gagal'] as $status)
                                <option {{ Request::get('status') == $status ? 'selected' : '' }} value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mt-3">
                        <h4>Urutkan Berdasarkan Pembayaran</h4>
                        <label for="">Pilih Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="" class="form-select">
                            <option value="">Pilih Status</option>
                            @foreach(['Cash On Delivery', 'kasir', 'Bayar Melalui Dana', 'Bayar Melalui BNI', 'Bayar Melalui BCA'] as $status)
                                <option {{ Request::get('payment_mode') == $status ? 'selected' : '' }} value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="tablePesanan" class="table display text-nowrap mb-0 align-middle">
                    @push('tableJs')
                        <script>
                            let table = new DataTable('#tablePesanan');
                        </script>
                    @endpush
                    <thead class="text-dark fs-4">
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Id Pesanan</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Tracking No</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Username</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Metode Pembayaran</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Tanggal Pesanan</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Status Pesanan</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0 text-center">Action</h6>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order )
                            <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('AdminOrder.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus Pesanan ini?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                                <tr>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $loop->index + 1 }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $order->id }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $order->no_tracking }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $order->user->name }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $order->payment_mode }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $order->created_at }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold text-capitalize">
                                            {{ $order->status_message }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0"><span class="fw-semibold"></span>
                                        <a href="{{ route('AdminOrder.show', $order->id) }}" class="btn btn-primary ">View</a>
                                        {{-- <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" class="btn btn-danger">Delete</a> --}}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                            <path d="M12 8v4"></path>
                                            <path d="M12 16h.01"></path>
                                        </svg>
                                        <br>
                                        Belum ada Pesanan
                                    </td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div>
                {{-- {{ $orders->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
