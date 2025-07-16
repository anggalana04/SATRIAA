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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_id'); // Using unsignedBigInteger for better clarity
            $table->string('nama');
            $table->string('deskripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->integer('jumlah_relawan_dibutuhkan')->default(0);
            $table->integer('jumlah_relawan_terdaftar')->default(0);
            $table->string('lokasi');
            $table->string('kontak');
            $table->enum('status', ['pending', 'aktif', 'selesai'])->default('pending');
            $table->enum('kategori', ['Kesehatan', 'Bencana', 'Pendidikan', 'Sosial dan Kesejahteraan', 'Pemberdayaan Masyarakat', 'Keagamaan', 'Lainnya'])->default('Bencana');
            $table->string('foto');
            $table->foreign('organisasi_id')->references('id')->on('organisasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
