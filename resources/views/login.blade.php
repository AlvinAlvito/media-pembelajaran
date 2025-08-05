<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pembelajaran Biologi</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Open+Sans&display=swap"
        rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link href="css/templatemo-topic-listing.css" rel="stylesheet">

</head>

<body id="top">

    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi-back text-light"></i>
                    <span class="text-light">Pembelajaran Biologi</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="/" class="modal-content">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title">Login Admin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->has('login'))
                                    <div class="alert alert-danger">{{ $errors->first('login') }}</div>
                                @endif
                                <div class="mb-3">
                                    <label>Username:</label>
                                    <input type="text" name="username" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password:</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-5 me-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_1">Beranda</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_2">Tujuan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_3">Materi</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_4">Rangkuman</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="#section_6">Kontak</a>
                        </li>
                    </ul>


                    <div class="d-none d-lg-block">
                        <a href="#top" data-bs-toggle="modal" data-bs-target="#loginModal"
                            class="navbar-icon bi-person smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>
        <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">

                    <div class="col-lg-10 col-12 mx-auto text-center">
                        <h1 class="text-white">Media Pembelajaran Biologi</h1>

                        <h6 class="text-white mt-3">
                            Sistem Regulasi Kelas XI – Interaktif, Edukatif, dan Mudah Dipahami
                        </h6>

                        <a href="#section_materi" class="btn btn-light btn-lg mt-4">
                            Mulai Belajar
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <section class="featured-section">
            <div class="container">
                <div class="row justify-content-center">

                    <!-- KD (Kompetensi Dasar) -->
                    <div class="col-lg-4 col-12 mb-4 mb-lg-0">
                        <div class="custom-block bg-white shadow-lg h-100">
                            <div class="d-flex flex-column h-100">
                                <div>
                                    <h5 class="mb-3">Kompetensi Dasar (KD)</h5>
                                    <ol class="mb-0 ps-3">
                                        <li>Menganalisis mekanisme sistem regulasi pada manusia yang meliputi sistem
                                            saraf, sistem hormon (endokrin), dan alat indra.</li>
                                        <li>Menyajikan hasil analisis tentang sistem regulasi pada manusia dalam bentuk
                                            model, gambar, atau media lain.</li>
                                    </ol>
                                </div>
                                <span class="badge bg-design rounded-pill mt-auto align-self-end">🎯</span>
                            </div>
                        </div>
                    </div>

                    <!-- Tujuan Pembelajaran -->
                    <div class="col-lg-6 col-12">
                        <div class="custom-block custom-block-overlay h-100">
                            <div class="d-flex flex-column h-100">
                                <img src="images/topics/tujuan-pembelajaran.jpg" class="custom-block-image img-fluid"
                                    alt="Ilustrasi Tujuan Pembelajaran">

                                <div class="custom-block-overlay-text d-flex">
                                    <div>
                                        <h5 class="text-white mb-3">Tujuan Pembelajaran</h5>
                                        <ol class="text-white ps-3">
                                            <li>Siswa dapat mengidentifikasi komponen utama sistem saraf, sistem hormon,
                                                dan alat indra manusia beserta fungsinya.</li>
                                            <li>Siswa dapat menjelaskan proses penghantaran impuls pada sistem saraf dan
                                                mekanisme kerja hormon dalam tubuh.</li>
                                            <li>Siswa dapat menganalisis hubungan antara sistem saraf, hormon, dan alat
                                                indra dalam mengatur fungsi tubuh secara homeostatis.</li>
                                            <li>Siswa dapat membuat model/gambar atau media presentasi untuk menjelaskan
                                                mekanisme kerja sistem regulasi manusia.</li>
                                        </ol>
                                    </div>
                                    <span class="badge bg-success rounded-pill ms-auto">🎓</span>
                                </div>

                                <div class="section-overlay"></div>
                                <div class="social-share d-flex">
                                    <p class="text-white me-4">Bagikan:</p>
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-twitter"></a>
                                        </li>
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-facebook"></a>
                                        </li>
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link bi-pinterest"></a>
                                        </li>
                                    </ul>
                                    <a href="#" class="custom-icon bi-bookmark ms-auto"></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="explore-section section-padding" id="section_2">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="mb-4">Jelajahi Materi</h2>
                    </div>
                </div>
            </div>
            {{-- Kategori Materi --}}
            <div class="container-fluid">
                <div class="row">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($kategori as $key => $k)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ $key === 0 ? 'active' : '' }}" id="tab-{{ $k->id }}"
                                    data-bs-toggle="tab" data-bs-target="#tab-pane-{{ $k->id }}"
                                    type="button" role="tab" aria-controls="tab-pane-{{ $k->id }}"
                                    aria-selected="{{ $key === 0 ? 'true' : 'false' }}">{{ $k->nama }}</button>
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>
            {{-- Isi materi berdasarkan kategori --}}
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="tab-content" id="myTabContent">
                            @foreach ($kategori as $key => $k)
                                <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}"
                                    id="tab-pane-{{ $k->id }}" role="tabpanel"
                                    aria-labelledby="tab-{{ $k->id }}">
                                    <div class="row mt-4">
                                        @forelse ($k->materi as $item)
                                            <div class="col-lg-4 col-md-6 col-12 mb-4">
                                                <div
                                                    class="custom-block bg-white shadow-lg h-100 d-flex flex-column justify-content-between">
                                                    <a href="{{ route('materi.show', $item->id) }}">
                                                        <div class="d-flex">
                                                            <div>
                                                                <h5 class="mb-2">{{ $item->judul }}</h5>
                                                                <p class="mb-0">
                                                                    {{ \Illuminate\Support\Str::words(strip_tags($item->isi), 10, '...') }}
                                                                </p>
                                                            </div>
                                                            <span
                                                                class="badge bg-secondary rounded-pill ms-auto">📚</span>
                                                        </div>
                                                        @if ($item->gambar)
                                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                                class="custom-block-image img-fluid mt-3"
                                                                alt="gambar materi"
                                                                style="object-fit: cover; width: 100%; height: 200px;">
                                                        @endif
                                                    </a>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <p class="text-muted">Belum ada materi di kategori ini.</p>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
        </section>


        <section class="timeline-section section-padding" id="section_3">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-12 text-center">
                        <h2 class="text-white mb-4">Bagaimana Cara Belajarnya?</h2>
                    </div>

                    <div class="col-lg-10 col-12 mx-auto">
                        <div class="timeline-container">
                            <ul class="vertical-scrollable-timeline" id="vertical-scrollable-timeline">
                                <div class="list-progress">
                                    <div class="inner"></div>
                                </div>

                                <li>
                                    <h4 class="text-white mb-3">1. Baca Materi Interaktif</h4>
                                    <p class="text-white">
                                        Mulailah dengan membaca penjelasan sistem saraf, sistem hormon, dan alat indera
                                        secara terstruktur dan mudah dipahami.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-journal-text"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">2. Tonton Video Pembelajaran</h4>
                                    <p class="text-white">
                                        Dukung pemahamanmu dengan visualisasi dan animasi dari video pembelajaran yang
                                        disediakan di halaman khusus.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-play-btn"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">3. Pelajari Rangkuman</h4>
                                    <p class="text-white">
                                        Simak ringkasan poin-poin penting dari setiap materi agar kamu lebih mudah
                                        mengingat konsep utama sistem regulasi.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-lightbulb"></i>
                                    </div>
                                </li>

                                <li>
                                    <h4 class="text-white mb-3">4. Ikuti Kuis Evaluasi</h4>
                                    <p class="text-white">
                                        Uji pemahamanmu melalui soal-soal pilihan ganda berbasis pendekatan saintifik
                                        untuk mengukur penguasaan materi.
                                    </p>
                                    <div class="icon-holder">
                                        <i class="bi-check-circle"></i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-12 text-center mt-5">
                        <p class="text-white">
                            Ingin belajar lebih dalam?
                            <a href="https://www.youtube.com/results?search_query=sistem+regulasi+biologi"
                                target="_blank" class="btn custom-btn custom-border-btn ms-3">Kunjungi YouTube</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section section-padding" id="section_4">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12">
                        <h2 class="mb-4">Pertanyaan yang Sering Diajukan</h2>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-5 col-12">
                        <img src="images/faq_graphic.jpg" class="img-fluid" alt="FAQ Sistem Regulasi">
                    </div>

                    <div class="col-lg-6 col-12 m-auto">
                        <div class="accordion" id="accordionExample">

                            <!-- FAQ 1 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        Apa itu sistem regulasi dalam tubuh manusia?
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Sistem regulasi adalah sistem yang mengatur, mengoordinasi, dan menjaga
                                        kestabilan tubuh manusia melalui sistem saraf, hormon, dan alat indera agar
                                        tubuh bisa merespon perubahan lingkungan dengan baik.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ 2 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        Mengapa penting mempelajari sistem saraf dan hormon?
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Karena sistem saraf dan hormon berperan penting dalam mengatur berbagai fungsi
                                        tubuh seperti gerakan, emosi, metabolisme, pertumbuhan, dan respons terhadap
                                        stres atau bahaya.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ 3 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Apakah tersedia latihan soal atau kuis evaluasi?
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ya! Di akhir pembelajaran, kamu bisa mengerjakan kuis evaluasi berupa soal
                                        pilihan ganda berbasis pendekatan saintifik untuk menguji pemahamanmu.
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ 4 -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        Apakah materi di platform ini bisa diakses gratis?
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Ya, seluruh materi pembelajaran di platform ini dapat diakses secara gratis oleh
                                        siswa kelas XI untuk menunjang proses belajar Biologi.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>




    </main>

    <footer class="site-footer section-padding">
        <div class="container">
            <div class="row">

                <!-- Branding -->
                <div class="col-lg-3 col-12 mb-4 pb-2">
                    <a class="navbar-brand mb-2" href="index.html">
                        <i class="bi-book-half"></i>
                        <span>Media Biologi</span>
                    </a>
                    <p class="text-white mt-2">Platform pembelajaran interaktif untuk memahami sistem regulasi tubuh
                        manusia.</p>
                </div>

                <!-- Navigasi -->
                <div class="col-lg-3 col-md-4 col-6">
                    <h6 class="site-footer-title mb-3">Navigasi</h6>
                    <ul class="site-footer-links">
                        <li class="site-footer-link-item">
                            <a href="index.html" class="site-footer-link">Beranda</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#section_2" class="site-footer-link">Materi</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="#section_3" class="site-footer-link">Cara Belajar</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="video.html" class="site-footer-link">Video</a>
                        </li>
                        <li class="site-footer-link-item">
                            <a href="kuis-evaluasi.html" class="site-footer-link">Kuis</a>
                        </li>
                    </ul>
                </div>

                <!-- Kontak -->
                <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                    <h6 class="site-footer-title mb-3">Kontak</h6>
                    <p class="text-white d-flex mb-1">
                        <a href="mailto:biologi.xi@media.com" class="site-footer-link">
                            biologi.xi@media.com
                        </a>
                    </p>
                    <p class="text-white d-flex">
                        <a href="https://instagram.com/biologi_xi" target="_blank" class="site-footer-link">
                            @biologi_xi
                        </a>
                    </p>
                </div>

                <!-- Copyright -->
                <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                    <p class="copyright-text mt-lg-5 mt-4">
                        &copy; 2025 Media Biologi XI. All rights reserved.
                        <br><br>Created by: <a href="https://avinto.my.id" target="_blank">PristiwDion</a>
                    </p>
                </div>

            </div>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
        integrity="sha384-7qAoOXltbVP82dhxHAUje59V5r2YsVfBafyUDxEdApLPmcdhBPg1DKg1ERo0BZlK" crossorigin="anonymous">
    </script>
    <!-- JAVASCRIPT FILES -->
    <script src="script/jquery.min.js"></script>
    <script src="script/bootstrap.bundle.min.js"></script>
    <script src="script/jquery.sticky.js"></script>
    <script src="script/click-scroll.js"></script>
    <script src="script/custom.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</body>

</html>
