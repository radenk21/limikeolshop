@extends('layouts.admin')
@section('title', 'Edit Produk')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success d-flex justify-content-between">
            {{ session()->get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-middle">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-detail-produk-tab" data-bs-toggle="tab" data-bs-target="#nav-detail-produk" type="button" role="tab" aria-controls="nav-detail-produk" aria-selected="true">Detail Produk</button>
                        <button class="nav-link" id="nav-jenis-tab" data-bs-toggle="tab" data-bs-target="#nav-jenis" type="button" role="tab" aria-controls="nav-jenis" aria-selected="false">Jenis Produk</button>
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
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3">{{ $produk->deskripsi }}</textarea>
                            @error('deskripsi')
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
                            @error('supplier')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="id_brand" class="form-label">Brand</label>
                            <select name="id_brand" class="form-control" id="id_brand">
                                <option value="">Pilih Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $produk->id_brand == $brand->id ? "selected" : "" }}>{{ $brand->name }}</option>
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
                </div>
            </div>
        </div>
    </form>
    <div class="card tab-pane fade" id="nav-jenis" role="tabpanel" aria-labelledby="nav-jenis-tab" tabindex="0">
        <div class="card-body">
            <form action="{{ route('produkidJenis.store', $produk->id) }}" method="post">
                @csrf
                <div class="row">
                    <label for="jenis" class="form-label">Daftar Jenis</label>
                    @forelse ($jeniss as $jenis)
                        <div class="col-md-3 mb-3">
                            Nama Jenis : <br>
                            <input type="checkbox" name="jeniss[{{ $jenis->id }}]" value="{{ $jenis->id }}">
                            {{ $jenis->name }}
                            <br>
                            Jumlah: 
                            <input type="number" name="jumlah_jenis[{{ $jenis->id }}]" class="form-control" >
                            <br>
                        </div>
                    @empty
                        <h3>Belum ada Jenis</h3>
                    @endforelse
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-primary" type="submit">Edit</button>
                    </div>
                </div>
            </form>
            <div class="table table-responsive">
                <table class="table">
                    <thead class="table text-nowrap">
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Nama Jenis</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Jumlah</h6>
                        </th>
                        <th class="border-bottom">
                            <h6 class="fw-semibold mb-0">Action</h6>
                        </th>
                    </thead>
                    <tbody>
                        @forelse ($produk->produkJenis as $prodJenis )
                            <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content"  style="background-color: white">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('produkJenis.destroy', $prodJenis->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus jenis produk ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                <button type="submit" value="{{ $prodJenis->id }}" class="deleteProdukJenis btn btn-danger">Ya, Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <tr class="prod-jenis-tr">
                                <td class="border-bottom-0">
                                    <span class="fw-semibold text-center">
                                        {{ $loop->index + 1 }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="fw-semibold">
                                        {{ $prodJenis->id_jenis }}
                                    </span>
                                </td>
                                <td class="border-bottom-0">
                                    <form action="{{ route('produkJenis.update', $prodJenis->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <span class="fw-semibold">
                                            <input type="number" class="produkJenisJumlah form-control" name="jumlah_jenis[{{ $prodJenis->id_jenis }}]" id="" value="{{ $prodJenis->jumlah }}">
                                        </span>
                                        <button type="submit" value="{{ $prodJenis->id }}" class="updateProdukJenis btn btn-primary btn-sm text-white mt-2">Update</button>
                                    </form>
                                </td>
                                <td class="border-bottom-0"><span class="fw-semibold"></span>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle" width="30" height="30" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                                <path d="M12 8v4"></path>
                                                <path d="M12 16h.01"></path>
                                            </svg>
                                            <br>
                                            Belum ada jenis dimasukkan
                                        </td>
                                    </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- <div class="card">
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
                        @error('supplier')
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
    </div> --}}
    {{-- <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.updateProdukJenis', function () {
                var prod_jenis_id = $(this).val();
                var produk_id = "{{ $produk->id }}"
                var jumlah = $(this).closest('.prod-jenis-tr').find('.produkJenisJumlah').val();
                alert(jumlah);
                if (jumlah <= 0) {
                    alert('Jumlah jenis harus di isi');
                    return false
                }

                var data = {
                    'id_produk': produk_id,
                    'id_jenis': prod_jenis_id
                    'jumlah': jumlah,
                }

                $.ajax({
                    type: "POST",
                    // url: "{{ route('produkJenis.update', ['produkJenis' => 'prod_jenis_id']) }}",
                    url: "/admin/produkJenis/"+prod_jenis_id,
                    data: data,
                    success: function (response) {
                        alert(response.message);
                    }
                });
            });
        });
    </script> --}}
@endsection