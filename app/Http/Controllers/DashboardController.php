<?php

namespace App\Http\Controllers;

use App\Models\SesiJawab;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Chart 1: Distribusi Nilai
        $range = [
            '0-20' => 0,
            '21-40' => 0,
            '41-60' => 0,
            '61-80' => 0,
            '81-100' => 0
        ];

        foreach (SesiJawab::all() as $sesi) {
            $nilai = $sesi->nilai;
            if ($nilai <= 20)
                $range['0-20']++;
            elseif ($nilai <= 40)
                $range['21-40']++;
            elseif ($nilai <= 60)
                $range['41-60']++;
            elseif ($nilai <= 80)
                $range['61-80']++;
            else
                $range['81-100']++;
        }

        // Chart 2: Jumlah peserta per materi
        $pesertaPerMateri = SesiJawab::with('materi')
            ->selectRaw('materi_id, COUNT(*) as total')
            ->groupBy('materi_id')
            ->get()
            ->mapWithKeys(fn($s) => [$s->materi->judul ?? 'Tidak Diketahui' => $s->total])
            ->toArray();

        // Chart 3: Rata-rata nilai per materi
        $rataRataNilai = SesiJawab::with('materi')
            ->selectRaw('materi_id, AVG(nilai) as rata')
            ->groupBy('materi_id')
            ->get()
            ->mapWithKeys(fn($s) => [$s->materi->judul ?? 'Tidak Diketahui' => round($s->rata, 2)])
            ->toArray();

        // Chart 4: Aktivitas kuis per hari
        $aktivitasHarian = SesiJawab::selectRaw('DATE(created_at) as tanggal, COUNT(*) as total')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('total', 'tanggal')
            ->toArray();


        return view('admin.index', compact(
            'range',
            'pesertaPerMateri',
            'rataRataNilai',
            'aktivitasHarian'
        ));
    }
}
