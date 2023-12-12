@extends('layouts.karyawan')
@section('title', 'Detail Pemesanan Produk')
@section('pemesananActive', 'active')
@section('content')
    <div class="container" style="margin-top: 10%;">
        @if(session('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if(session('danger-alert'))
        <div class="alert alert-danger d-flex justify-content-between">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    
        <div class="card" style="max-width: 1920px; background-color: white">
            <div class="card-header d-flex justify-content-between align-middle">
                <h3 class="me-5">
                    Detail Pemesanan Produk
                </h3>
                <a href="{{ route('KaryawanPemesananProduk.index') }}" class="btn btn-primary">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('KaryawanPemesananProduk.update', $pemesananProduk->id) }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" value="{{ $pemesananProduk->produk->name }}" class="form-control-plaintext" name="name" readonly>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nama_supplier" class="form-label">Nama Supplier</label>
                            <input type="text" value="{{ $pemesananProduk->supplier->name }}" class="form-control-plaintext" name="nama_supplier" readonly>
                            @error('nama_supplier')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" value="{{ $pemesananProduk->supplier->no_telp }}" class="form-control-plaintext" name="nomor_telepon" readonly>
                            @error('nomor_telepon')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="jumlah_beli_stok" class="form-label">Jumlah Restock Produk</label>
                            <input type="number" value="{{ $pemesananProduk->jumlah_beli_stok }}" id="jumlah_beli_stok" class="form-control card-text" name="jumlah_beli_stok">
                            <button class="btn btn-outline-secondary" type="button" id="tambahJumlah">Tambah</button>
                            @error('jumlah_beli_stok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="total_harga_pesan" class="form-label">Kalkulasi Harga Beli</label>
                            <input type="text" id="total_harga_pesan" class="form-control card-text" name="total_harga_pesan" readonly>
                            @error('total_harga_pesan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
    
                        <input type="hidden" id="hidden_total_harga_pesan" name="hidden_total_harga_pesan">
                        
                        <script>
                            document.getElementById('tambahJumlah').addEventListener('click', function () {
                                var jumlahBeliStok = parseInt(document.getElementById('jumlah_beli_stok').value) || 0;
                                var hargaBeliProduk = parseInt("{{ $pemesananProduk->produk->harga_beli }}") || 0;
                                var totalHargaPesan = jumlahBeliStok * hargaBeliProduk;
                        
                                // Format angka sebagai Rupiah
                                var formatter = new Intl.NumberFormat('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });
                        
                                document.getElementById('total_harga_pesan').value = formatter.format(totalHargaPesan);
                                document.getElementById('hidden_total_harga_pesan').value = totalHargaPesan;
                            });
                        </script>                
        
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-primary mt-2" type="submit">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection