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
        Schema::create('log_action_payment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_payment');
            $table->enum('action', ['update', 'insert', 'drop']);
            $table->enum('keterangan', ['terverifikasi', 'belum di verifikasi', 'gagal', 'batal', 'menghapus', 'menambahkan']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_action_payment');
    }
};
