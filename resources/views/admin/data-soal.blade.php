{{-- layouts/main.blade.php --}}
@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here...">
            </div>
            <img src="/images/profil.png" alt="">
        </div>

        <div class="dash-content">
            <div class="activity">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="title">
                        <i class="bi bi-question-circle me-2"></i>
                        <span class="text fs-5">Data Soal</span>
                    </div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Soal
                    </button>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table id="tabelFuzzifikasi" class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Materi</th>
                                <th>Pertanyaan</th>
                                <th>Pilihan A</th>
                                <th>Pilihan B</th>
                                <th>Pilihan C</th>
                                <th>Pilihan D</th>
                                <th>Pilihan E</th>
                                <th>Jawaban</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->materi->judul ?? '-' }}</td>
                                    <td>{{ $item->pertanyaan }}</td>
                                    <td>{{ $item->pilihan_a }}</td>
                                    <td>{{ $item->pilihan_b }}</td>
                                    <td>{{ $item->pilihan_c }}</td>
                                    <td>{{ $item->pilihan_d }}</td>
                                    <td>{{ $item->pilihan_e }}</td>
                                    <td>{{ strtoupper($item->jawaban_benar) }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{ route('soal.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin hapus soal ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> 
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Modal Tambah --}}
                <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="{{ route('soal.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Soal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- Form Langsung --}}
                                    <div class="mb-3">
                                        <label for="materi_id" class="form-label">Materi</label>
                                        <select name="materi_id" class="form-select" required>
                                            <option value="">-- Pilih Materi --</option>
                                            @foreach ($materi as $m)
                                                <option value="{{ $m->id }}">{{ $m->judul }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                        <textarea name="pertanyaan" class="form-control" rows="2" required></textarea>
                                    </div>

                                    @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                                        <div class="mb-3">
                                            <label for="pilihan_{{ $opt }}" class="form-label">Pilihan
                                                {{ strtoupper($opt) }}</label>
                                            <input type="text" name="pilihan_{{ $opt }}" class="form-control"
                                                required>
                                        </div>
                                    @endforeach

                                    <div class="mb-3">
                                        <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                                        <select name="jawaban_benar" class="form-select" required>
                                            @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                                                <option value="{{ $opt }}">Pilihan {{ strtoupper($opt) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Modal Edit --}}
                <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form action="{{ route('soal.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Soal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    {{-- Form Edit Soal --}}
                                    {{-- Form Edit Soal --}}
                                    <div class="mb-3">
                                        <label for="materi_id" class="form-label">Materi</label>
                                        <select name="materi_id" class="form-select" required>
                                            @foreach ($materi as $m)
                                                <option value="{{ $m->id }}"
                                                    {{ $item->materi_id == $m->id ? 'selected' : '' }}>
                                                    {{ $m->judul }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                                        <textarea name="pertanyaan" class="form-control" rows="2" required>{{ $item->pertanyaan }}</textarea>
                                    </div>

                                    @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                                        <div class="mb-3">
                                            <label for="pilihan_{{ $opt }}" class="form-label">Pilihan
                                                {{ strtoupper($opt) }}</label>
                                            <input type="text" name="pilihan_{{ $opt }}"
                                                class="form-control" value="{{ $item['pilihan_' . $opt] }}" required>
                                        </div>
                                    @endforeach

                                    <div class="mb-3">
                                        <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                                        <select name="jawaban_benar" class="form-select" required>
                                            @foreach (['a', 'b', 'c', 'd', 'e'] as $opt)
                                                <option value="{{ $opt }}"
                                                    {{ $item->jawaban_benar == $opt ? 'selected' : '' }}>
                                                    Pilihan {{ strtoupper($opt) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="modal-footer">
                                        <button class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#tabelFuzzifikasi').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data yang ditemukan",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data tersedia",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "columnDefs": [{
                    "orderable": false,
                    "targets": "_all"
                }]
            });
        });
    </script>
@endsection
