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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('no_tracking');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->string('pincode');
            $table->mediumText('address');
            $table->integer('total_harga')->default(0);
            $table->enum('status_message', ['terverifikasi', 'belum di verifikasi', 'batal', 'selesai', 'dalam proses', 'pending', 'gagal']);
            $table->string('payment_mode');
            $table->unsignedBigInteger('id_payment')->nullable();

            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_payment')->references('id')->on('payments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
