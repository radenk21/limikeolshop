<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan_produks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_supplier');
            $table->enum('status', ['belum di pesan', 'telah di pesan', 'belum di restock', 'sudah restock', 'batal']);
            $table->integer('jumlah_stok_sekarang');
            $table->integer('jumlah_beli_stok')->nullable();
            $table->integer('total_harga_pesan')->default(0);
            
            $table->foreign('id_produk')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_supplier')->references('id')->on('suppliers')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan_produks');
    }
};
