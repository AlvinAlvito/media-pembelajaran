<?php

// use App\Http\Controllers\Api\ChartController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\SiswaController;

// ===================
// Halaman Login
// ===================
Route::get('/', function () {
    return view('login');
})->name('login');

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

// ===================
// Dashboard Admin
// ===================
use App\Http\Controllers\DashboardController;

Route::get('/admin', function () {
    if (!session('is_admin')) {
        return redirect('/');
    }
    return app(DashboardController::class)->index(); // <-- GANTI view() ke controller
})->name('index');


// ===================
// CRUD Data Materi
// ===================
Route::get('/admin/data-Materi', function () {
    if (!session('is_admin')) return redirect('/');
    return app(MateriController::class)->index();
})->name('Materi.index');

Route::post('/admin/data-Materi', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(MateriController::class)->store($request);
})->name('Materi.store');

Route::delete('/admin/data-Materi/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(MateriController::class)->destroy($id);
})->name('Materi.destroy');
Route::put('/admin/data-Materi/{id}', function (Request $request, $id) {
    if (!session('is_admin')) return redirect('/');
    return app(App\Http\Controllers\MateriController::class)->update($request, $id);
})->name('Materi.update');


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

Route::delete('/admin/data-Soal/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(SoalController::class)->destroy($id);
})->name('soal.destroy');
Route::put('/admin/data-Soal/{id}', function (Request $request, $id) {
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

Route::post('/admin/data-Siswa', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(SiswaController::class)->store($request);
})->name('siswa.store');

Route::delete('/admin/data-siswa/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(SiswaController::class)->destroy($id);
})->name('siswa.destroy');
Route::put('/admin/data-Siswa/{id}', function (Request $request, $id) {
    if (!session('is_admin')) return redirect('/');
    return app(App\Http\Controllers\SiswaController::class)->update($request, $id);
})->name('siswa.update');


// Route::get('/chart/sektor', [ChartController::class, 'buahPerSektor']);
// Route::get('/chart/pegawai', [ChartController::class, 'buahPerPegawai']);
// Route::get('/chart/cuaca', [ChartController::class, 'buahPerCuaca']);
// Route::get('/chart/pendapatan-tertinggi', [ChartController::class, 'pendapatanTertinggi']);