<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'materi_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban_benar',
    ];

    /**
     * Relasi: satu soal milik satu materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Relasi: satu soal bisa memiliki banyak jawaban dari siswa.
     */
    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class, 'soal_id');
    }
}
