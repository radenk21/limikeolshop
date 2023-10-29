@extends('layouts.admin')
@section('title', 'Edit Produk')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Tambah Produk
            </h3>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control card-text" value="{{ $produk->name }}" name="name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control card-text" value="{{ $produk->slug }}" name="slug">
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <select name="id_supplier" class="form-control" id="id_supplier">
                            <option value="">Pilih Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ $selectedSupplier = $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                @endforeach
                        </select>
                        @error('slug')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="id_kategori" class="form-label">Main Kategori</label>
                        <select name="id_kategori" class="form-control" id="id_kategori">
                            <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ $produk->subKategori->kategori->id = $kategori->id ? "selected" : '' }}>{{ $kategori->name }}</option>
                                @endforeach
                        </select>
                        @error('id_kategori')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="id_sub_kategori" class="form-label">Sub Kategori</label>
                        <select name="id_sub_kategori" class="form-control" id="id_sub_kategori">
                            <option value="{{ $produk->subKategori->id }}" selected>{{ $produk->subKategori->name }}</option>
                        </select>
                        @error('id_sub_kategori')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <script>
                        $(document).ready(function() {
                            $('#id_kategori').on('change', function () {
                                var id_kategori = $(this).val();
                                // console.log(id_kategori);
                                if(id_kategori) {
                                    $.ajax({
                                        url: 'get-subcategories/' + id_kategori,
                                        type:'GET',
                                        data: {
                                            '_token': '{{ csrf_token() }}'
                                        },
                                        dataType: 'json',
                                        success: function(data){
                                            // console.log('adf');
                                            $('#id_sub_kategori').empty();
                                            $('#id_sub_kategori').append('<option value="">Pilih Subkategori</option>'); // Tambahkan opsi default
                                            $.each(data, function(key, subKategori) {
                                                // console.log(subKategori.id);
                                                $('#id_sub_kategori').append('<option value="' + subKategori.id + '" data-id="' + subKategori.id + '">' + subKategori.name + '</option>');
                                            });
                                        }
                                    });
                                } else {
                                    $('#id_sub_kategori').empty();
                                        $('#id_sub_kategori').append('<option value="">Pilih Subkategori</option>'); // Tambahkan opsi default jika kategori tidak dipilih
                                }
                            })
                        }) 
                    </script>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label><br>
                        @if ($produk->gambarProduk)
                            <div class="row">
                                @foreach ($produk->gambarProduk as $gambar)
                                    <div class="col-md-3">
                                        <img src="{{ asset($gambar->image) }}" class="border" width="60" height="60" alt="">
                                        <a class="d-block btn btn-sm btn-danger mb-3" href="{{ url('admin/gambar-produk/'.$gambar->id.'/delete') }}" onclick="return confirm('Apakah anda yakin ingin menghapus gambar ini?')">remove</a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h4>Belum ada gambar</h4>
                        @endif
                    <input type="file" class="form-control card-text" multiple name="image[]">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="number" value="{{ $produk->harga_beli }}" class="form-control card-text" name="harga_beli">
                        @error('harga_beli')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="number" value="{{ $produk->harga_jual }}" class="form-control card-text" name="harga_jual">
                        @error('harga_jual')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="number" value="{{ $produk->jumlah}}" class="form-control card-text" name="jumlah">
                        @error('jumlah')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="trending" class="form-label">Trending</label><br>
                        <input type="checkbox" name="trending" {{ $produk->trending == '1' ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label">Status</label><br>
                        <input type="checkbox" name="status" {{ $produk->status == '1' ? 'checked' : '' }}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Edit</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection