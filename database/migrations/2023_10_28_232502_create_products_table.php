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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori')->nullable();
            $table->unsignedBigInteger('id_sub_kategori')->nullable();
            $table->unsignedBigInteger('id_brand')->nullable();
            $table->string('name')->unique();
            $table->string('slug');
            $table->integer('harga_beli');
            $table->integer('harga_jual');
            $table->integer('jumlah');

            $table->tinyInteger('trending')->default(0)->comment('1 = trending, 0 = not trending');
            $table->tinyInteger('status')->default(0)->comment('1 = hidden, 0 = visible');

            $table->timestamps();
            $table->foreign('id_kategori')->references('id')->on('kategoris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_sub_kategori')->references('id')->on('sub_kategoris')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('id_brand')->references('id')->on('brands')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
