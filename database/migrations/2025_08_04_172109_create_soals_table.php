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
    Schema::create('soal', function (Blueprint $table) {
        $table->id();
        $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
        $table->text('pertanyaan');
        $table->string('pilihan_a')->nullable();
        $table->string('pilihan_b')->nullable();
        $table->string('pilihan_c')->nullable();
        $table->string('pilihan_d')->nullable();
        $table->string('pilihan_e')->nullable();
        $table->char('jawaban_benar', 1); // 'A' - 'E'
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
