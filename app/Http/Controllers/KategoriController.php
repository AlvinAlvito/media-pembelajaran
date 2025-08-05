<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100|unique:kategori,nama',
        ]);

        \App\Models\Kategori::create([
            'nama' => $request->nama,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

}
