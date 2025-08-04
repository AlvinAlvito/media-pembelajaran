<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sesi_jawab', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
            $table->integer('jumlah_benar')->default(0);
            $table->integer('total_soal')->default(0);
            $table->float('nilai')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_jawabs');
    }
};
