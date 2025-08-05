<?php

// QuizController.php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Materi;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index($materi_id)
    {
        // Cek apakah ID materi valid
        $materi = Materi::findOrFail($materi_id);

        // Ambil soal berdasarkan ID materi
        $soal = Soal::where('materi_id', $materi_id)->get();

        // Ubah data soal ke format JavaScript
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
}
