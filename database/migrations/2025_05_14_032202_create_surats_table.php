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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_surat_id')->constrained()->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nik', 20);
            $table->text('alamat');
            $table->date('tanggal_terbit');
            $table->string('nomor_surat')->unique();
            $table->json('data_lainnya')->nullable(); // Untuk field tambahan tiap jenis surat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
