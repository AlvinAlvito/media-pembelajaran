<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi';
    protected $fillable = [
        'kategori_id', // tambahkan ini
        'judul',
        'slug',
        'gambar',
        'isi',
        'link_video',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }


    /**
     * Relasi: satu materi memiliki banyak soal.
     */
    public function soal()
    {
        return $this->hasMany(Soal::class);
    }

    /**
     * Relasi: satu materi bisa memiliki banyak sesi jawaban.
     */
    public function sesiJawab()
    {
        return $this->hasMany(SesiJawab::class);
    }
}
