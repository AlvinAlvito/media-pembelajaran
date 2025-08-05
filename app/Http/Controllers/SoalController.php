<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
{
    public function index()
    {
        $soal = Soal::with('materi')->latest()->get();
        $materi = Materi::all();
        return view('admin.data-soal', compact('soal', 'materi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required|exists:materi,id',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d,e',
        ]);

        Soal::create($request->all());
        return back()->with('success', 'Soal berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'materi_id' => 'required|exists:materi,id',
            'pertanyaan' => 'required|string',
            'pilihan_a' => 'required|string',
            'pilihan_b' => 'required|string',
            'pilihan_c' => 'required|string',
            'pilihan_d' => 'required|string',
            'pilihan_e' => 'required|string',
            'jawaban_benar' => 'required|in:a,b,c,d,e',
        ]);

        $soal->update($request->all());
        return back()->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();
        return back()->with('success', 'Soal berhasil dihapus.');
    }
}
