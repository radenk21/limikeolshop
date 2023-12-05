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
        DB::unprepared('
            CREATE TRIGGER after_insert_order
            AFTER INSERT ON order_items FOR EACH ROW
            BEGIN
                DECLARE product_count INT;
                SELECT jumlah INTO product_count
                FROM products
                WHERE id = NEW.id_produk;
            
                UPDATE products
                SET jumlah = product_count - NEW.jumlah
                WHERE id = NEW.id_produk;
            END;
        ');
        DB::unprepared("
            CREATE TRIGGER after_payment_update
            AFTER UPDATE ON payments
            FOR EACH ROW
            BEGIN
                CASE NEW.payment_status
                    WHEN 'terverifikasi' THEN
                        UPDATE orders
                        SET status_message = 'dalam proses'
                        WHERE id = NEW.id_order;
                    ELSE
                        UPDATE orders
                        SET status_message = NEW.payment_status
                        WHERE id = NEW.id_order;
                END CASE;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER log_action_order_insert_trigger
            AFTER INSERT ON orders
            FOR EACH ROW
            BEGIN
                INSERT INTO log_action_order (id_user, id_order, action, keterangan, created_at, updated_at)
                VALUES (NEW.id_user, NEW.id, 'insert', NEW.status_message, NOW(), NOW());
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER log_action_order_update_trigger
            AFTER UPDATE ON orders
            FOR EACH ROW
            BEGIN
                INSERT INTO log_action_order (id_user, id_order, action, keterangan, created_at, updated_at)
                VALUES (NEW.id_user, NEW.id, 'update', NEW.status_message, NOW(), NOW());
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER log_action_order_delete_trigger
            BEFORE DELETE ON orders
            FOR EACH ROW
            BEGIN
                INSERT INTO log_action_order (id_user, id_order, action, keterangan, created_at, updated_at)
                VALUES (OLD.id_user, OLD.id, 'drop', OLD.status_message, NOW(), NOW());
            END;
        ");
        
        DB::unprepared("
            CREATE TRIGGER after_payment_action 
            AFTER INSERT ON payments
            FOR EACH ROW
            BEGIN
                INSERT INTO log_action_payment (id_user, id_payment, action, keterangan, created_at)
                VALUES (NEW.id_user, NEW.id, 'insert', NEW.payment_status, NOW());
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER after_payment_delete_action 
            BEFORE DELETE ON payments
            FOR EACH ROW
            BEGIN
                INSERT INTO log_action_payment (id_user, id_payment, action, keterangan, created_at)
                VALUES (OLD.id_user, OLD.id, 'drop', OLD.payment_status, NOW());
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER after_payment_update_action 
            AFTER UPDATE ON payments
            FOR EACH ROW
            BEGIN
                IF NEW.payment_status != OLD.payment_status THEN
                    INSERT INTO log_action_payment (id_user, id_payment, action, keterangan, created_at)
                    VALUES (NEW.id_user, NEW.id, 'update', NEW.payment_status, NOW());
                END IF;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER check_and_order_trigger 
            AFTER UPDATE ON produks
            FOR EACH ROW
            BEGIN
                DECLARE jumlah_produk INT;
                DECLARE id_supplier_produk INT;
                DECLARE produk_exists INT;
            
                SET jumlah_produk = NEW.jumlah;
            
                SELECT id_supplier INTO id_supplier_produk FROM produk_suppliers WHERE id_produk = NEW.id LIMIT 1;
            
                IF jumlah_produk < 20 THEN
                    SELECT COUNT(*) INTO produk_exists FROM pemesanan_produks WHERE id_produk = NEW.id LIMIT 1;
            
                    IF produk_exists > 0 THEN
                        UPDATE pemesanan_produks
                        SET jumlah_stok_sekarang = jumlah_produk,
                            updated_at = NOW()
                        WHERE id_produk = NEW.id;
                    ELSE
                        INSERT INTO pemesanan_produks (id_produk, id_supplier, status, jumlah_stok_sekarang, jumlah_beli_stok, created_at, updated_at)
                        VALUES (NEW.id, id_supplier_produk, 'belum di pesan', jumlah_produk, 0, NOW(), NOW());
                    END IF;
                END IF;
            END;
        ");
        DB::unprepared("
            CREATE TRIGGER tr_update_produk_after_restok 
            BEFORE UPDATE ON pemesanan_produks
            FOR EACH ROW
            BEGIN
                DECLARE jlh_stok_sekarang INT;
            
                IF NEW.status = 'sudah restock' AND OLD.status != 'sudah restock' THEN
                    UPDATE produks
                    SET jumlah = jumlah + NEW.jumlah_beli_stok
                    WHERE id = NEW.id_produk;
            
                    SELECT jumlah INTO jlh_stok_sekarang FROM produks WHERE id = NEW.id_produk;
            
                    SET NEW.jumlah_stok_sekarang = jlh_stok_sekarang;
                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS after_insert_order");
        DB::unprepared("DROP TRIGGER IF EXISTS after_payment_update");
        DB::unprepared("DROP TRIGGER IF EXISTS log_action_order_insert_trigger");
        DB::unprepared("DROP TRIGGER IF EXISTS log_action_order_update_trigger");
        DB::unprepared("DROP TRIGGER IF EXISTS log_action_order_delete_trigger");
        DB::unprepared("DROP TRIGGER IF EXISTS check_and_order_trigger");
        DB::unprepared("DROP TRIGGER IF EXISTS after_payment_action");
        DB::unprepared("DROP TRIGGER IF EXISTS after_payment_delete_action");
        DB::unprepared("DROP TRIGGER IF EXISTS after_payment_update_action");
        DB::unprepared("DROP TRIGGER IF EXISTS check_and_order_trigger");
        DB::unprepared("DROP TRIGGER IF EXISTS tr_update_produk_after_restok");
    }
};
