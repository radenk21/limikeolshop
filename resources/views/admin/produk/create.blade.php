@extends('layouts.admin')
@section('title', 'Tambah Produk')
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
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

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
                                            // console.log(data);
                                            // $('#id_sub_kategori').empty();
                                            //     $('#id_sub_kategori').append('<option value="">Pilih Subkategori</option>'); // Tambahkan opsi default
                                            //     $.each(data, function(key, subKategori) {
                                            //         $('#id_sub_kategori').append('<option value="' + key + '">' + subKategori.name + '</option>');
                                            //     });
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
                    
                    {{-- <script>
                        jQuery.noConflict();
                        (function($) {
                            $(document).ready(function() {
                                $('#id_kategori').on('change',function() {
                                    var id_kategori = $(this).val();
                                    console.log($id_kategori);
                                    if (id_kategori) {
                                        $.ajax({
                                            url: '/get-subcategories/' + id_kategori,
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(data) {
                                                $('#id_sub_kategori').empty();
                                                $('#id_sub_kategori').append('<option value="">Pilih Subkategori</option>'); // Tambahkan opsi default
                                                $.each(data, function(key, value) {
                                                    $('#id_sub_kategori').append('<option value="' + key + '">' + value + '</option>');
                                                });
                                            }
                                        });
                                    } else {
                                        $('#id_sub_kategori').empty();
                                        $('#id_sub_kategori').append('<option value="">Pilih Subkategori</option>'); // Tambahkan opsi default jika kategori tidak dipilih
                                    }
                                });
                            });
                        })(jQuery);
                    </script> --}}
                    
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
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary mt-2" type="submit">Tambah</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
@endsection