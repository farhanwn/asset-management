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
        Schema::create('pemeliharaan_asets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pelaporan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('aset_id')->constrained('asets')->onDelete('cascade');
            $table->foreignId('ruangan_id')->constrained('ruangans')->onDelete('cascade');
            $table->longText('catatan');
            $table->text('foto');
            $table->integer('status')->default(0);
            $table->string('created_by');
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeliharaan_asets');
    }
};
