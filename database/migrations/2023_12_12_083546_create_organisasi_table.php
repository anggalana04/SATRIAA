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
        Schema::create('organisasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('ketua')->nullable();
            $table->enum('kategori', ['Kesehatan', 'Pendidikan', 'Lingkungan Hidup', 'HAM', 'Keagamaan', 'Olahraga dan Kesenian'])->default('Lingkungan Hidup');
            $table->string('visi')->nullable();
            $table->string('misi')->nullable();
            $table->string('id_sertifikasi')->nullable();
            $table->string('id_npwp')->nullable();
            $table->integer('jumlah_jam_kerja')->default(0);
            $table->integer('jumlah_donasi')->default(0);
            $table->string('foto')->nullable();
            $table->string('rating')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->string('email')->nullable();
            $table->string('wa')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisasi');
    }
};
