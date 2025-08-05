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

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link href="/css/templatemo-topic-listing.css" rel="stylesheet">

</head>

<body id="top">

    <main>

        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <i class="bi-back"></i>
                    <span>Pembelajaran Biologi</span>
                </a>

                <div class="d-lg-none ms-auto me-4">
                    <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

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
                        <a href="#top" class="navbar-icon bi-person smoothscroll"></a>
                    </div>
                </div>
            </div>
        </nav>




        {{-- HEADER --}}
        <header class="site-header d-flex flex-column justify-content-center align-items-center">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5 col-12 mb-5">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Homepage</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $materi->kategori->nama ?? '-' }}</li>
                            </ol>
                        </nav>

                        <h2 class="text-white">{{ $materi->judul }}</h2>

                        <div class="d-flex align-items-center mt-5">
                            <a href="{{ url('/#section_2') }}" class="btn custom-btn custom-border-btn me-4">
                                <i class="bi bi-arrow-left-circle me-2"></i> Kembali Ke Beranda
                            </a>


                            @php
                                $videoId = null;
                                if ($materi->link_video) {
                                    preg_match(
                                        '/(?:youtube\.com.*(?:\?|&)v=|youtu\.be\/)([a-zA-Z0-9_-]+)/',
                                        $materi->link_video,
                                        $matches,
                                    );
                                    $videoId = $matches[1] ?? null;
                                }
                            @endphp

                        </div>
                    </div>

                    <div class="col-lg-5 col-12">
                        @if ($videoId)
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video"
                                    allowfullscreen></iframe>
                            </div>
                        @else
                            <div class="topics-detail-block bg-white shadow-lg">
                                <img src="{{ asset('images/default.jpg') }}" class="topics-detail-block-image img-fluid"
                                    alt="Gambar Default">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </header>


        {{-- ISI MATERI --}}
        <section class="topics-detail-section section-padding" id="topics-detail">


            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12 m-auto">
                        <h3 class="mb-4">{{ $materi->judul }}</h3>
                        {{-- Gambar Materi Full Width --}}
                        @if ($materi->gambar)
                            <div class="w-100 mb-4">
                                <img src="{{ asset('storage/' . $materi->gambar) }}" class="img-fluid w-100"
                                    style="max-height: 500px; object-fit: cover;" alt="Gambar Materi">
                            </div>
                        @endif
                        {{-- Isi Materi --}}
                        <div class="isi-materi">
                            {!! $materi->isi !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>



        {{-- FORM QUIZ --}}
        <section class="section-padding section-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-12">
                        <img src="{{ asset('images/rear-view-young-college-student.jpg') }}"
                            class="newsletter-image img-fluid" alt="">
                    </div>

                    <div class="col-lg-5 col-12 subscribe-form-wrap d-flex justify-content-center align-items-center">
                        <form class="custom-form subscribe-form" action="#" method="post" role="form">
                            <h4 class="mb-4 pb-2">Ayo Mainkan Quiz Untuk Menambah Pengetahuanmu</h4>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Masukan Nama Kamu.." required="">
                            <div class="col-lg-12 col-12">
                                <button type="submit" onclick="window.location.href='/quiz'" class="form-control">Mainkan Quizz</button>

                            </div>
                        </form>
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
    <script src="/script/jquery.min.js"></script>
    <script src="/script/bootstrap.bundle.min.js"></script>
    <script src="/script/jquery.sticky.js"></script>
    <script src="/script/click-scroll.js"></script>
    <script src="/script/custom.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</body>

</html>
