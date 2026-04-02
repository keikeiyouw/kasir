<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('ProdukID');
            $table->integer('jumlah')->default(1);
            $table->timestamps();

            $table->foreign('ProdukID')->references('ProdukID')->on('produk')->onDelete('cascade');
            $table->unique(['user_id', 'ProdukID']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keranjang');
    }
};