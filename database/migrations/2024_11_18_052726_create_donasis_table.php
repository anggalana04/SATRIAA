<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisasi_id');
            $table->string('nama');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('deskripsi');
            $table->decimal('target_donasi', 15, 2)->nullable();
            $table->decimal('jumlah_donasi', 15, 2)->default(0);
            $table->enum('status', ['pending', 'aktif', 'selesai'])->default('pending');
            $table->enum('kategori', ['Kesehatan', 'Bencana', 'Pendidikan', 'Sosial dan Kesejahteraan', 'Pemberdayaan Masyarakat', 'Keagamaan', 'Lainnya'])->default('Bencana');
            $table->string('lokasi');
            $table->string('rekening/VA');
            $table->string('foto')->nullable();
            $table->foreign('organisasi_id')->references('id')->on('organisasi')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasi');
    }
};
