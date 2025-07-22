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
        Schema::create('guru_matkul_kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreignId('mapel_id')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            $table->foreignId('guru_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreignId('tahun_ajaran_id')->references('id')->on('tahun_ajarans')->onDelete('cascade');
             $table->string('hari')->nullable();
             $table->time('jam_mulai')->nullable();
             $table->time('jam_selesai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru_matkul_kelas');
    }
};
