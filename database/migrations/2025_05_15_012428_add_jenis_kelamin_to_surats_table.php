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
        Schema::table('surats', function (Blueprint $table) {
            $table->string('jenis_kelamin')->after('nik');
            $table->string('pekerjaan')->after('alamat');
            $table->string('keperluan')->after('nomor_surat')->nullable();
            $table->foreignId('ttd_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('pekerjaan');
            $table->dropColumn('keperluan');
            $table->dropColumn('ttd_id');
        });
    }
};
