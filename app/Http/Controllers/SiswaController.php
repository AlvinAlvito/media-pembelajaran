<?php

namespace App\Http\Controllers;

use App\Models\SesiJawab;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil semua data sesi jawab dan relasi materi
        $siswa = SesiJawab::with('materi')->latest()->get();
        return view('admin.data-siswa', compact('siswa'));
    }

    public function destroy($id)
    {
        $sesi = SesiJawab::findOrFail($id);
        $sesi->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
