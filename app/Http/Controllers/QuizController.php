<?php

// QuizController.php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Materi;
use App\Models\SesiJawab;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index($materi_id)
    {
        $materi = Materi::findOrFail($materi_id);
        $soal = Soal::where('materi_id', $materi_id)->get();

        $questions = [];

        foreach ($soal as $index => $item) {
            $questions[] = [
                'numb' => $index + 1,
                'question' => $item->pertanyaan,
                'answer' => $item['pilihan_' . $item->jawaban_benar],
                'options' => [
                    $item->pilihan_a,
                    $item->pilihan_b,
                    $item->pilihan_c,
                    $item->pilihan_d,
                    $item->pilihan_e,
                ],
            ];
        }

        return view('public.quiz', [
            'questions' => $questions,
            'materi' => $materi
        ]);
    }

    public function submitResult(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required|string',
            'materi_id' => 'required|exists:materi,id',
            'jumlah_benar' => 'required|integer',
            'total_soal' => 'required|integer',
            'nilai' => 'required|numeric'
        ]);

        $sesi = SesiJawab::create([
            'nama_siswa' => $request->nama_siswa,
            'materi_id' => $request->materi_id,
            'jumlah_benar' => $request->jumlah_benar,
            'total_soal' => $request->total_soal,
            'nilai' => $request->nilai,
        ]);

        return response()->json(['success' => true, 'sesi_id' => $sesi->id]);
    }
}
