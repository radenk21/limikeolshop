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
        Schema::create('log_action_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_order');
            $table->enum('action', ['update', 'insert', 'drop']);
            $table->enum('keterangan', ['terverifikasi', 'belum di verifikasi', 'batal', 'selesai', 'dalam proses', 'pending', 'gagal', 'menghapus', 'menambahkan']);
            
            $table->foreign('id_user')->references('id')->on('users')->noActionOnDelete()->cascadeOnUpdate();
            $table->foreign('id_order')->references('id')->on('orders')->noActionOnDelete()->cascadeOnUpdate();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_action_order');
    }
};
