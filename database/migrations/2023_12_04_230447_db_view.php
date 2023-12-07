<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE VIEW keuntungan_perhari AS
            SELECT CAST(o.updated_at AS DATE) AS tanggal,
                SUM(oi.jumlah * (p.harga_jual - p.harga_beli)) AS keuntungan
            FROM orders o
            JOIN order_items oi ON o.id = oi.id_order
            JOIN products p ON oi.id_produk = p.id
            WHERE o.status_message = 'selesai'
            GROUP BY tanggal;
        ");
        DB::unprepared("
            CREATE VIEW pengeluaran AS
            SELECT
                p.name AS nama_produk,
                b.name AS nama_brand,
                s.name AS nama_supplier,
                s.email,
                s.no_telp,
                s.alamat,
                pr.status,
                pr.jumlah_beli_stok,
                pr.total_harga_pesan,
                pr.created_at
            FROM
                pemesanan_produks pr
            JOIN
                products p ON p.id = pr.id_produk
            JOIN
                brands b ON b.id = p.id
            JOIN
                suppliers s ON s.id = pr.id_supplier
            WHERE
                pr.status NOT IN ('batal', 'belum di pesan');
        ");
        DB::unprepared("
            CREATE VIEW penjualan_perhari AS
            SELECT
                CAST(o.created_at AS DATE) AS tanggal,
                COUNT(o.id) AS jumlah_penjualan,
                SUM(o.total_harga) AS total_penjualan
            FROM
                orders o
            WHERE
                o.status_message = 'selesai'
            GROUP BY
                CAST(o.created_at AS DATE)
            ORDER BY
                tanggal;        
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP VIEW keuntungan_perhari");
        DB::unprepared("DROP VIEW pengeluaran");
        DB::unprepared("DROP VIEW penjualan_perhari");
    }
};
