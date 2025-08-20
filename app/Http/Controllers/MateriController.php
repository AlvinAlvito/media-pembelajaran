<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MateriController extends Controller
{
    /**
     * Tampilkan semua data materi.
     */
    public function index()
    {
        $materi = Materi::with('kategori')->latest()->get();
        $kategori = Kategori::all();
        return view('admin.data-materi', compact('materi', 'kategori'));
    }

    /**
     * Simpan data materi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'nullable|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi' => 'nullable',
            'link_video' => 'nullable|url',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('materi'), $filename);
            $gambarPath = 'materi/' . $filename; // path relatif dari public
        }

        Materi::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori_id' => $request->kategori_id,
            'gambar' => $gambarPath,
            'isi' => $request->isi,
            'link_video' => $request->link_video,
        ]);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    /**
     * Update data materi.
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'nullable|exists:kategori,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'isi' => 'nullable',
            'link_video' => 'nullable|url',
        ]);

        $data = [
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'kategori_id' => $request->kategori_id,
            'isi' => $request->isi,
            'link_video' => $request->link_video,
        ];

        if ($request->hasFile('gambar')) {
            // hapus gambar lama kalau ada
            if ($materi->gambar && file_exists(public_path($materi->gambar))) {
                unlink(public_path($materi->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('materi'), $filename);
            $data['gambar'] = 'materi/' . $filename;
        }

        $materi->update($data);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Hapus data materi.
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);

        // Hapus file gambar utama jika ada
        if ($materi->gambar && file_exists(public_path($materi->gambar))) {
            unlink(public_path($materi->gambar));
        }

        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    public function show($id)
    {
        $materi = Materi::with('kategori')->findOrFail($id);
        return view('materi.show', compact('materi'));
    }

    /**
     * Upload gambar dari CKEditor.
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('materi'), $filename);

            $url = asset('materi/' . $filename);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
    }
}
