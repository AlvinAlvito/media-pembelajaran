@extends('layouts.main')

@section('content')
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
                <div class="title">
                    <i class="uil uil-book-open"></i>
                    <span class="text">Data Materi</span>
                </div>

                @if (session('success'))
                    <div class="alert alert-success mt-2">{{ session('success') }}</div>
                @endif

                <div class="row mb-3">
                    <div class="col-lg-2 ">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
                            <i class="uil uil-plus"></i> Tambah Materi
                        </button>
                    </div>
                    <div class="col-lg-2 ">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                            <i class="uil uil-folder-plus"></i> Tambah Kategori
                        </button>
                    </div>
                </div>


                <div class="row">
                    @forelse ($materi as $item)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100 d-flex flex-column">
                                @if ($item->gambar)
                                    <img src="{{ asset($item->gambar) }}" class="card-img-top img-fluid" alt="gambar materi"
                                        style="height: 300px; object-fit: cover; width: 100%; min-width: 100%;">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    {{-- Konten utama --}}
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">{{ $item->judul }}</h5>
                                        <p class="card-text mb-1">
                                            <strong>Kategori:</strong> {{ $item->kategori->nama ?? '-' }}
                                        </p>
                                        <p class="card-text mb-1">
                                            {{ \Illuminate\Support\Str::words(strip_tags($item->isi), 10, '...') }}
                                        </p>
                                        <p class="card-text">
                                            <strong>Video:</strong>
                                            @if ($item->link_video)
                                                <a href="{{ $item->link_video }}" target="_blank">Lihat Video</a>
                                            @else
                                                <span class="text-muted">Tidak ada</span>
                                            @endif
                                        </p>
                                    </div>

                                    {{-- Tombol aksi --}}
                                    <div class="row mt-3">
                                        <div class="col-6 pe-1">
                                            <button class="btn btn-primary w-100" data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $item->id }}">
                                                <i class="uil uil-edit"></i> Edit
                                            </button>
                                        </div>
                                        <div class="col-6 ps-1">
                                            <form action="{{ route('materi.destroy', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin hapus materi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger w-100">
                                                    <i class="uil uil-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">Belum ada data materi.</p>
                        </div>
                    @endforelse
                </div>



            </div>
        </div>
    </section>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" required>
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Link Video</label>
                                <input type="url" name="link_video" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Gambar Cover</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Isi Materi</label>
                            <textarea name="isi" id="editorIsi"></textarea>
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


    <!-- Modal Edit -->
    @foreach ($materi as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('materi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Materi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Judul</label>
                                    <input type="text" name="judul" class="form-control"
                                        value="{{ $item->judul }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Kategori</label>
                                    <select name="kategori_id" class="form-control">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $item->kategori_id == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Link Video</label>
                                    <input type="url" name="link_video" class="form-control"
                                        value="{{ $item->link_video }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Ganti Gambar Cover (opsional)</label>
                                    <input type="file" name="gambar" class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Isi Materi</label>
                                {{-- ID unik agar tiap modal beda --}}
                                <textarea name="isi" id="editorIsi{{ $item->id }}">{{ $item->isi }}</textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach



    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Summernote CSS & JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>



    <script>
        $(function() {
            $('#datatable').DataTable();
        });
    </script>
    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        // Tambah Materi
        ClassicEditor
            .create(document.querySelector('#editorIsi'), {
                ckfinder: {
                    uploadUrl: "{{ route('materi.upload') }}?_token={{ csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
            });

        // Edit Materi (looping semua modal edit)
        @foreach ($materi as $item)
            ClassicEditor
                .create(document.querySelector('#editorIsi{{ $item->id }}'), {
                    ckfinder: {
                        uploadUrl: "{{ route('materi.upload') }}?_token={{ csrf_token() }}"
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        @endforeach
    </script>
@endsection
