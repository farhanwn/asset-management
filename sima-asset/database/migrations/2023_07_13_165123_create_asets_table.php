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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kode_barang');
            $table->string('tahun')->nullable();
            $table->string('satuan');
            $table->bigInteger('jumlah')->default(0)->nullable();
            $table->bigInteger('harga_satuan');
            $table->bigInteger('harga_total')->nullable();
            $table->boolean('kondisi')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asets');
    }
};
