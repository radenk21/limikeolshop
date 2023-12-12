@extends('layouts.karyawan')
@section('title', 'Daftar Pemesanan Produk')
@section('pemesananActive', 'active')
@section('content')

<div class="container" style="margin-top: 5%;max-width: 1920px;">
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
    <div class="card" style="max-width: 1920px;background-color: white">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>Daftar Pemesanan Produk</h3>
        </div>
        <div class="card-body">
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col-md-5">
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
                    <div class="col-md-4">
                        <h4>Urutkan Berdasarkan Status</h4>
                        <label for="">Pilih Status</label>
                        <select name="status" id="" class="form-select">
                            <option value="">Pilih Status</option>
                            @foreach(['belum di pesan', 'telah di pesan', 'belum di restock', 'sudah restock', 'batal'] as $status)
                                <option {{ Request::get('status') == $status ? 'selected' : '' }} value="{{ $status }}">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="tabelPemesanan" class="table text-nowrap mb-0 align-middle">
                    @push('tableJs')
                        <script>
                            let table = new DataTable('#tabelPemesanan');
                        </script>
                    @endpush

                    <thead class="text-dark fs-4">
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Nama Produk</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Stok Sekarang</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Stok Yang di Pesan</h6>
                        </th>
                        <th class="border-bottom text-center">
                            <h6 class="fw-semibold mb-0">Status</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Waktu Pesanan di Buat</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Waktu Pesanan di Update</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0 text-center">Action</h6>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($pemesananProduks as $pemesananProduk )
                            <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('PemesananProdukK.verifikasiPesanan', $pemesananProduk->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                Apakah anda yakin ingin memverifikasi pemesanan ini?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-success">Ya, verifikasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="batalModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('PemesananProdukK.batalPesanan', $pemesananProduk->id) }}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="modal-body">
                                                Apakah anda yakin ingin membatalkan pemesanan ini?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-danger">Ya, batalkan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="hapusModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('KaryawanPemesananProduk.destroy', $pemesananProduk->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus pemesanan ini?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                            <button type="submit" class="btn btn-danger">Ya, hapuskan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                <tr>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $offset + $loop->index + 1 }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="fw-semibold">
                                            {{ $pemesananProduk->produk->name }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <span class="fw-semibold">
                                            {{ $pemesananProduk->produk->jumlah }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <span class="fw-semibold">
                                            {{ $pemesananProduk->jumlah_beli_stok }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        @php
                                            $badgeClass = '';
                                            switch($pemesananProduk->status) {
                                                case 'belum di pesan':
                                                    $badgeClass = 'text-bg-danger';
                                                    break;
                                                case 'batal':
                                                    $badgeClass = 'text-bg-danger';
                                                    break;
                                                case 'telah di pesan':
                                                    $badgeClass = 'text-bg-warning';
                                                    break;
                                                case 'belum di restock':
                                                    $badgeClass = 'text-bg-info';
                                                    break;
                                                default:
                                                    $badgeClass = 'text-bg-secondary';
                                            }
                                        @endphp
                                        <span class="fw-semibold text-capitalize badge {{ $badgeClass }}">
                                            {{ $pemesananProduk->status }}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <span class="fw-semibold">
                                            {{ $pemesananProduk->created_at}}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0 text-center">
                                        <span class="fw-semibold">
                                            {{ $pemesananProduk->updated_at}}
                                        </span>
                                    </td>
                                    <td class="border-bottom-0 d-flex justify-content-center">
                                        <div class="row">
                                            <div>
                                                <a href="{{ route('KaryawanPemesananProduk.edit', $pemesananProduk->id) }}" class="btn btn-primary 
                                                    @if($pemesananProduk->status != "belum di pesan")
                                                        disabled
                                                    @else
                                                        
                                                    @endif
                                                    ">Restock</a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" class="btn btn-success ms-3
                                                    @if($pemesananProduk->status != "sudah restock" && $pemesananProduk->status != "belum di pesan" && $pemesananProduk->status != "batal")
                                                    @else
                                                        disabled
                                                    @endif
                                                    ">Verifikasi Stock</a>
                                                <a href="" data-bs-toggle="modal" data-bs-target="#batalModal{{ $loop->index }}" class="btn btn-danger ms-3
                                                    @if($pemesananProduk->status != "sudah restock" && $pemesananProduk->status != "batal")
                                                    @else
                                                        disabled
                                                    @endif
                                                    ">Batal</a>
                                                @if($pemesananProduk->status == "batal")
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $loop->index }}" class="btn btn-danger ms-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
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
                                        Belum ada Pemesanan Produk
                                    </td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- <div>
                {{ $pemesananProduks->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
