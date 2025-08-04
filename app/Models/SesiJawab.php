<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiJawab extends Model
{
    use HasFactory;

    protected $table = 'sesi_jawab';

    protected $fillable = [
        'nama_siswa',
        'materi_id',
        'jumlah_benar',
        'total_soal',
        'nilai',
    ];

    /**
     * Relasi: satu sesi jawab milik satu materi.
     */
    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    /**
     * Relasi: satu sesi jawab memiliki banyak jawaban siswa.
     */
    public function jawabanSiswa()
    {
        return $this->hasMany(JawabanSiswa::class, 'sesi_id');
    }
}
