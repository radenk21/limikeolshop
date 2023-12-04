@extends('layouts.admin')
@section('title', 'Report Pengeluaran')
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
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h3>
                Report Pengeluaran
            </h3>
            {{-- <a href="{{ route('sub-kategori.create') }}" class="btn btn-primary">Tambah Sub Kategori</a> --}}
        </div>
        <div class="card-body">
            <form action="" method="get" class="mb-3">
                <div class="row">
                    <div class="col-md-9">
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
                    <div class="col-md-3 align-self-end">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table id="tableReportPengeluaran" class="display table text-nowrap mb-0 align-middle">
                    @php
                        $totalPengeluaran = 0;
                    @endphp
                    <thead>
                        <tr>
                            <th>
                                No.
                            </th>
                            <th>
                                Nama Produk
                            </th>
                            <th>
                                Nama Supplier
                            </th>
                            <th>
                                Nomor Telepon
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Jumlah Beli
                            </th>
                            <th>
                                Tanggal
                            </th>
                            <th>
                                Jumlah Pengeluaran
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportPengeluarans as $reportPengeluaran)
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    {{ $reportPengeluaran->nama_produk }}
                                </td>
                                <td>
                                    {{ $reportPengeluaran->nama_supplier }}
                                </td>
                                <td>
                                    {{ $reportPengeluaran->no_telp }}
                                </td>
                                <td>
                                    {{ $reportPengeluaran->status }}
                                </td>
                                <td>
                                    {{ $reportPengeluaran->jumlah_beli_stok }}
                                </td>
                                <td>
                                    {{ $reportPengeluaran->created_at }}
                                </td>
                                <td>Rp {{ number_format($reportPengeluaran->total_harga_pesan, 0, '.', '.') }}</td>
                                @php
                                    $totalPengeluaran += $reportPengeluaran->total_harga_pesan;
                                @endphp
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td colspan="2" class="text-center">Total Pengeluaran</td>
                            <td> Rp {{ number_format($totalPengeluaran, 0, '.', '.') }}</td>
                        </tr> --}}
                    </tbody>
                </table>
                @push('tableJs')
                    <script>
                        // let table = new DataTable('#tableReportPengeluaran');
                        $(document).ready( function () {
                            var table = $('#tableReportPengeluaran').DataTable({
                                dom: '<"top"lBfrt>ip',
                                buttons: [
                                    {
                                        extend: 'print',
                                        className: 'btn btn-primary ms-3',  // Menambahkan kelas CSS ke tombol cetak
                                        text: 'Cetak',
                                        title: 'Laporan Pengeluaran',
                                        customize: function (win) {
                                            $(win.document.body).find('h1').css('text-align', 'center');
                                        }
                                    }
                                ]
                            });

                            var $totalPengeluaran = {{ $totalPengeluaran }}
                            console.log($totalPengeluaran);
                            
                            table.row.add([
                                'Total Pengeluaran',
                                '',
                                '',
                                '',
                                '',
                                '',
                                '',
                                'Rp ' + '{{ number_format( $totalPengeluaran , 0, '.', '.') }}'
                            ]).draw(false);

                            // Mengambil jumlah baris setelah penambahan
                            table.rows().every(function (index, element) {
                                var data = this.data();
                                console.log(data, index);
                            });
                            
                            var $rowCount = table.rows().count();

                            console.log($rowCount);

                            // Mengganti urutan baris agar yang baru ditambahkan berada di akhir tabel
                            if ($rowCount > 2) {
                                table.order([$rowCount - 1, 'desc']).draw(false);
                            } else {
                                table.order([$rowCount - 1, 'asc']).draw(false);
                            }
                            var cellToMerge = table.cell({ row: table.rows().count() - 1, column: 0 });

                            // Menggabungkan sel untuk Total Pengeluaran
                            cellToMerge.node().colSpan = colCount;

                            // Menambahkan CSS untuk mengganti warna latar belakang sel Total Pengeluaran
                            cellToMerge.node().style.backgroundColor = '#f5f5f5';
                        });

                    </script>
                @endpush
            </div>
            <div>
                {{-- {{ $subKategoris->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection
