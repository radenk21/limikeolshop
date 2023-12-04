@extends('layouts.admin')
@section('title', 'Report Keuntungan')
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
                Report Keuntungan
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
                <table id="tableReportPenjualan" class="display table text-nowrap mb-0 align-middle">
                    @php
                        $totalPenjualan = 0;
                    @endphp
                    <thead>
                        <tr>
                            <th>
                                Tanggal
                            </th>
                            <th>
                                Keuntungan
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportKeuntungans as $reportKeuntungan)
                            <tr>
                                <td>{{ $reportKeuntungan->tanggal }}</td>
                                <td>Rp {{ number_format($reportKeuntungan->keuntungan, 0, '.', '.') }}</td>
                                @php
                                    $totalPenjualan += $reportKeuntungan->keuntungan;
                                @endphp
                            </tr>
                        @endforeach
                        {{-- <tr>
                            <td colspan="2" class="text-center">Total Keuntungan</td>
                            <td> Rp {{ number_format($totalPenjualan, 0, '.', '.') }}</td>
                        </tr> --}}
                    </tbody>
                </table>
                @push('tableJs')
                    <script>
                        // let table = new DataTable('#tableReportPenjualan');
                        $(document).ready( function () {
                            var table = $('#tableReportPenjualan').DataTable({
                                dom: '<"top"lBfrt>ip',
                                buttons: [
                                    {
                                        extend: 'print',
                                        className: 'btn btn-primary ms-3',  // Menambahkan kelas CSS ke tombol cetak
                                        text: 'Cetak',
                                        title: 'Laporan Keuntungan',
                                        customize: function (win) {
                                            $(win.document.body).find('h1').css('text-align', 'center');
                                        }
                                    }
                                ]
                            });

                            var $totalPenjualan = {{ $totalPenjualan }}
                            console.log($totalPenjualan);
                            
                            table.row.add([
                                'Total Keuntungan',
                                'Rp ' + '{{ number_format( $totalPenjualan , 0, '.', '.') }}'
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

                            // Menggabungkan sel untuk Total Keuntungan
                            cellToMerge.node().colSpan = colCount;

                            // Menambahkan CSS untuk mengganti warna latar belakang sel Total Keuntungan
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
