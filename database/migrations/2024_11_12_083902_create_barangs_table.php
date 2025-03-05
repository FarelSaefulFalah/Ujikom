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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50)->unique();
            $table->string('nomor_seri', 50)->unique(); // Nomor seri unik untuk setiap barang
            $table->string('nama', 255);
            $table->unsignedBigInteger('kategori_id');
            $table->integer('jumlah');
            $table->text('keterangan')->nullable();
            $table->string('gambar')->nullable();
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak'])->default('tersedia'); // Status barang
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};
