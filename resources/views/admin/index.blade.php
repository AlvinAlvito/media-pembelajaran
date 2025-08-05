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
            <div class="overview">
                <div class="title">
                    <i class="uil uil-chart-line"></i>
                    <span class="text">Dashboard Kuis & Pembelajaran</span>
                </div>
            </div>

            <div class="boxes">
                <div class="box box1">
                    <i class="uil uil-user"></i>
                    <span class="text">Total Peserta</span>
                    <span class="number">54</span>
                </div>
                <div class="box box2">
                    <i class="uil uil-book"></i>
                    <span class="text">Total Materi</span>
                    <span class="number">5</span>
                </div>
                <div class="box box3">
                    <i class="uil uil-edit-alt"></i>
                    <span class="text">Total Jawaban</span>
                    <span class="number">748</span>
                </div>
            </div>

            <div class="activity">
                <div class="title mb-3">
                    <i class="uil uil-chart-bar"></i>
                    <span class="text">Analisis Kuis</span>
                </div>

                <div class="row">
                    {{-- Chart 1: Distribusi Nilai --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2">Distribusi Nilai Siswa</h6>
                        <div id="chartDistribusiNilai"></div>
                    </div>

                    {{-- Chart 2: Jumlah Peserta per Materi --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2">Jumlah Peserta per Materi</h6>
                        <div id="chartPesertaMateri"></div>
                    </div>

                    {{-- Chart 3: Rata-rata Nilai per Materi --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2">Rata-rata Nilai per Materi</h6>
                        <div id="chartRataRataNilai"></div>
                    </div>

                    {{-- Chart 4: Aktivitas Quiz Harian --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="mb-2">Aktivitas Kuis per Hari</h6>
                        <div id="chartAktivitasHarian"></div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    {{-- ApexCharts CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Chart 1: Distribusi Nilai (diubah menjadi line chart)
        new ApexCharts(document.querySelector("#chartDistribusiNilai"), {
            chart: {
                type: 'line',
                height: 350
            },
            series: [{
                name: 'Jumlah Siswa',
                data: @json(array_values($range))
            }],
            xaxis: {
                categories: @json(array_keys($range))
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            markers: {
                size: 5,
                colors: ['#008FFB'],
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            colors: ['#00E396'],
            dataLabels: {
                enabled: true
            },
            tooltip: {
                enabled: true
            }
        }).render();

        // Chart 2: Jumlah Peserta per Materi
        new ApexCharts(document.querySelector("#chartPesertaMateri"), {
            chart: {
                type: 'donut'
            },
            series: @json(array_values($pesertaPerMateri)),
            labels: @json(array_keys($pesertaPerMateri))
        }).render();

        // Chart 3: Rata-rata Nilai per Materi
        new ApexCharts(document.querySelector("#chartRataRataNilai"), {
            chart: {
                type: 'bar'
            },
            series: [{
                name: 'Rata-rata Nilai',
                data: @json(array_values($rataRataNilai))
            }],
            xaxis: {
                categories: @json(array_keys($rataRataNilai))
            }
        }).render();

        // Chart 4: Aktivitas Kuis Harian
        new ApexCharts(document.querySelector("#chartAktivitasHarian"), {
            chart: {
                type: 'line'
            },
            series: [{
                name: 'Jumlah Kuis',
                data: @json(array_values($aktivitasHarian))
            }],
            xaxis: {
                categories: @json(array_keys($aktivitasHarian))
            }
        }).render();
    </script>
@endsection
