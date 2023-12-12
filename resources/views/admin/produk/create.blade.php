@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header d-flex justify-content-between align-middle">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-detail-produk-tab" data-bs-toggle="tab" data-bs-target="#nav-detail-produk" type="button" role="tab" aria-controls="nav-detail-produk" aria-selected="true">Detail Produk</button>
                        {{-- <button class="nav-link" id="nav-jenis-tab" data-bs-toggle="tab" data-bs-target="#nav-jenis" type="button" role="tab" aria-controls="nav-jenis" aria-selected="false">Tambah Jenis Produk</button> --}}
                    </div>
                </nav>
                <a href="{{ route('produk.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="tab-content" id="nav-tabContent">
            <div class="card tab-pane fade show active" id="nav-detail-produk" role="tabpanel" aria-labelledby="nav-detail-produk-tab" tabindex="0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control card-text" value="{{ old('name') }}" name="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control card-text" value="{{ old('slug') }}" name="slug">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror                    
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="supplier" class="form-label">Supplier</label>
                            <select name="id_supplier" class="form-control" id="id_supplier">
                                <option value="">Pilih Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                            </select>
                            @error('id_supplier')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_brand" class="form-label">Brand</label>
                            <select name="id_brand" class="form-control" id="id_brand">
                                <option value="">Pilih Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                            </select>
                            @error('id_brand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_kategori" class="form-label">Main Kategori</label>
                            <select name="id_kategori" class="form-control" id="id_kategori">
                                <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                            </select>
                            @error('id_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_sub_kategori" class="form-label">Sub Kategori</label>
                            <select name="id_sub_kategori" class="form-control" id="id_sub_kategori">
                                <option value="">Pilih Subkategori</option>
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
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control card-text" multiple value="{{ old('image') }}" name="image[]">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" value="{{ old('harga_beli') }}" class="form-control card-text" name="harga_beli">
                            @error('harga_beli')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" value="{{ old('harga_jual') }}" class="form-control card-text" name="harga_jual">
                            @error('harga_jual')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" value="{{ old('jumlah') }}" class="form-control card-text" name="jumlah">
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="trending" class="form-label">Trending</label><br>
                            <input type="checkbox" name="trending" {{ old('trending') }}>
                            @error('trending')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Status</label><br>
                            <input type="checkbox" name="status" {{ old('status') }}>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card tab-pane fade" id="nav-jenis" role="tabpanel" aria-labelledby="nav-jenis-tab" tabindex="0">
                <div class="card-body">
                    <div class="row">
                        <label for="jenis" class="form-label">Daftar Jenis</label>
                        @forelse ($jeniss as $jenis)
                            <div class="col-md-3 mb-3">
                                Nama Jenis : <br>
                                <input type="checkbox" name="jeniss[{{ $jenis->id }}]" value="{{ $jenis->id }}">
                                {{ $jenis->name }}
                                <br>
                                Jumlah: 
                                <input type="number" name="jumlah_jenis[{{ $jenis->id }}]" class="form-control">
                                <br>
                            </div>
                        @empty
                            <h3>Belum ada Jenis</h3>
                        @endforelse
                        
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-md-12 mb-3">
            <button class="btn btn-primary mt-2" type="submit">Tambah</button>
        </div>
    </form>
    {{-- <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Tambah Brand
            </h3>
            <a href="{{ route('produk.index') }}" class="btn btn-primary">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control card-text" value="{{ old('name') }}" name="name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control card-text" value="{{ old('slug') }}" name="slug">
                            @error('slug')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="supplier" class="form-label">Supplier</label>
                            <select name="id_supplier" class="form-control" id="id_supplier">
                                <option value="">Pilih Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                            </select>
                            @error('id_supplier')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <select name="brand" class="form-control" id="brand">
                                <option value="">Pilih Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                            </select>
                            @error('brand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_kategori" class="form-label">Main Kategori</label>
                            <select name="id_kategori" class="form-control" id="id_kategori">
                                <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                    @endforeach
                            </select>
                            @error('id_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_sub_kategori" class="form-label">Sub Kategori</label>
                            <select name="id_sub_kategori" class="form-control" id="id_sub_kategori">
                                <option value="">Pilih Subkategori</option>
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
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control card-text" multiple value="{{ old('image') }}" name="image[]">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga_beli" class="form-label">Harga Beli</label>
                            <input type="number" value="{{ old('harga_beli') }}" class="form-control card-text" name="harga_beli">
                            @error('harga_beli')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="harga_jual" class="form-label">Harga Jual</label>
                            <input type="number" value="{{ old('harga_jual') }}" class="form-control card-text" name="harga_jual">
                            @error('harga_jual')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" value="{{ old('jumlah') }}" class="form-control card-text" name="jumlah">
                            @error('jumlah')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="trending" class="form-label">Trending</label><br>
                            <input type="checkbox" name="trending" {{ old('trending') }}>
                            @error('trending')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Status</label><br>
                            <input type="checkbox" name="status" {{ old('status') }}>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Tambah</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div> --}}
@endsection