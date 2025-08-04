<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'sesi_id',
        'soal_id',
        'jawaban_siswa',
        'benar',
    ];

    /**
     * Relasi: jawaban ini milik satu sesi kuis.
     */
    public function sesiJawab()
    {
        return $this->belongsTo(SesiJawab::class, 'sesi_id');
    }

    /**
     * Relasi: jawaban ini milik satu soal.
     */
    public function soal()
    {
        return $this->belongsTo(Soal::class, 'soal_id');
    }
}
