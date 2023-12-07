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
            CREATE FUNCTION hitungTotalHarga(order_id_param bigint) RETURNS INT
            READS SQL DATA
            BEGIN
                DECLARE total_harga INT;
            
                SELECT SUM(harga) INTO total_harga
                FROM order_items
                WHERE id_order = order_id_param;
            
                RETURN total_harga;
            END;
        ");
        DB::unprepared("
            CREATE FUNCTION calculate_total_harga_keranjang(user_id INT) RETURNS INT
            READS SQL DATA
            BEGIN
                DECLARE total INT;
                SELECT SUM(k.jumlah * p.harga_jual) INTO total
                FROM keranjangs k
                JOIN products p ON k.id_produk = p.id
                WHERE k.id_user = user_id;
            
                RETURN total;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP FUNCTION IF EXISTS hitungTotalHarga');
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_total_harga_keranjang');
    }
};
