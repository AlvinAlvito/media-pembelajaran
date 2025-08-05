<?php

// use App\Http\Controllers\Api\ChartController;
use App\Models\Kategori;
use App\Models\Materi;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\QuizController;

use App\Http\Controllers\DashboardController;
// ===================
// Halaman Index & Login
// ===================
Route::get('/', function () {
    $kategori = Kategori::with('materi')->get(); // relasi kategori ke materi
    return view('login', compact('kategori'));
})->name('login');


Route::get('/materi/{id}', function ($id) {
    $materi = Materi::with('kategori')->findOrFail($id);
    return view('public.materi', compact('materi'));
})->name('materi.show');


// web.php
Route::get('/quiz/{materi_id}', [QuizController::class, 'index'])->name('quiz');
Route::post('/quiz/submit', [QuizController::class, 'submitResult'])->name('quiz.submit');



// ===================
// Proses Login Manual
// ===================
Route::post('/', function (Request $request) {
    $username = $request->username;
    $password = $request->password;

    if ($username === 'admin' && $password === '123') {
        session(['is_admin' => true]);
        return redirect('/admin');
    }

    return back()->withErrors(['login' => 'Username atau Password salah!']);
})->name('login.proses');

// ===================
// Logout
// ===================
Route::get('/logout', function () {
    session()->forget('is_admin');
    return redirect('/');
})->name('logout');


Route::get('/admin', function () {
    if (!session('is_admin')) return redirect('/');
    return app(DashboardController::class)->index();
})->name('admin.index');
// ===================
// CRUD Data Materi
// ===================
Route::get('/admin/data-materi', function () {
    if (!session('is_admin')) return redirect('/');
    return app(MateriController::class)->index();
})->name('materi.index');

Route::post('/admin/data-materi', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(MateriController::class)->store($request);
})->name('materi.store');

Route::delete('/admin/data-materi/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(MateriController::class)->destroy($id);
})->name('materi.destroy');
Route::put('/admin/data-materi/{id}', function (Request $request, $id) {
    if (!session('is_admin')) return redirect('/');
    return app(App\Http\Controllers\MateriController::class)->update($request, $id);
})->name('materi.update');


Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('kategori.store');


// ===================
// CRUD Data Soal
// ===================
Route::get('/admin/data-soal', function () {
    if (!session('is_admin')) return redirect('/');
    return app(SoalController::class)->index();
})->name('soal.index');

Route::post('/admin/data-soal', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(SoalController::class)->store($request);
})->name('soal.store');

Route::delete('/admin/data-soal/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(SoalController::class)->destroy($id);
})->name('soal.destroy');
Route::put('/admin/data-soal/{id}', function (Request $request, $id) {
    if (!session('is_admin')) return redirect('/');
    return app(App\Http\Controllers\SoalController::class)->update($request, $id);
})->name('soal.update');

// ===================
// CRUD Data Siswa
// ===================
Route::get('/admin/data-siswa', function () {
    if (!session('is_admin')) return redirect('/');
    return app(SiswaController::class)->index();
})->name('siswa.index');

Route::delete('/admin/data-siswa/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(SiswaController::class)->destroy($id);
})->name('siswa.destroy');

