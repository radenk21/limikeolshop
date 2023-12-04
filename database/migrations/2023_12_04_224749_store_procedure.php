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
            CREATE PROCEDURE cancel_order(IN canceled_order_id INT)
            BEGIN
                DECLARE product_id INT;
                DECLARE order_item_id INT;
                DECLARE order_item_count INT;
                DECLARE done INT DEFAULT FALSE;
            
                DECLARE order_items_cursor CURSOR FOR
                    SELECT id_produk, id, jumlah
                    FROM order_items
                    WHERE id_order = canceled_order_id;
            
                DECLARE CONTINUE HANDLER FOR NOT FOUND
                    SET done = TRUE;
            
                START TRANSACTION;
            
                OPEN order_items_cursor;
            
                read_loop: LOOP
                    FETCH order_items_cursor INTO product_id, order_item_id, order_item_count;
            
                    IF done THEN
                        LEAVE read_loop;
                    END IF;
            
                    UPDATE produks
                    SET jumlah = jumlah + order_item_count
                    WHERE id = product_id;
            
                END LOOP;
            
                CLOSE order_items_cursor;
            
                COMMIT;
            END;
        ");
        DB::unprepared("
            CREATE PROCEDURE checkout_keranjang_kasir(IN user_id INT)
            BEGIN
                DECLARE total_harga INT;
                DECLARE user_fullname VARCHAR(255);
                DECLARE user_email VARCHAR(255);
                DECLARE produk_id INT;
                DECLARE produk_jumlah INT;
                DECLARE produk_harga INT;
                DECLARE done INT DEFAULT FALSE;
            
                DECLARE keranjang_cursor CURSOR FOR
                    SELECT k.id_produk, k.jumlah, p.harga_jual
                    FROM keranjangs k
                    JOIN produks p ON k.id_produk = p.id
                    WHERE k.id_user = user_id;
            
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
            
                SELECT name, email INTO user_fullname, user_email
                FROM users
                WHERE id = user_id;
            
                SET total_harga = calculate_total_harga_keranjang(user_id);
            
                START TRANSACTION;
            
                INSERT INTO orders (id_user, no_tracking, fullname, email, phone, pincode, address, total_harga, status_message, payment_mode, id_payment, created_at, updated_at)
                VALUES (user_id, CONCAT('limike', SUBSTRING(MD5(RAND()), 1, 10)), user_fullname, user_email, '0', '20147', 'Limike Olshop, Jl. Panca Karya No.84c, Harjosari II, Kec. Medan Amplas, Kota Medan, Sumatera Utara 20147', total_harga, 'selesai', 'kasir', NULL, NOW(), NOW());
            
                
                OPEN keranjang_cursor;
            
                read_loop: LOOP
                    FETCH keranjang_cursor INTO produk_id, produk_jumlah, produk_harga;
                    IF done THEN
                        LEAVE read_loop;
                    END IF;
            
                    INSERT INTO order_items (id_order, id_produk, jumlah, harga, created_at, updated_at)
                    VALUES ((SELECT MAX(id) FROM orders WHERE id_user = user_id), produk_id, produk_jumlah, produk_jumlah * produk_harga, NOW(), NOW());
                END LOOP;
            
                CLOSE keranjang_cursor;
            
                DELETE FROM keranjangs WHERE id_user = user_id;
            
                COMMIT;
            END;
        ");
        DB::unprepared("
            CREATE PROCEDURE calculate_total_harga_keranjang(IN user_id INT, OUT total INT)
            BEGIN
                SELECT SUM(k.jumlah * p.harga_jual)
                INTO total
                FROM keranjangs k
                JOIN produks p ON k.id_produk = p.id
                WHERE k.id_user = user_id;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP PROECDURE IF EXISTS cancel_order');
        DB::unprepared('DROP PROECDURE IF EXISTS checkout_keranjang_kasir');
        DB::unprepared('DROP PROECDURE IF EXISTS calculate_total_harga_keranjang');
    }
};
