<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="/css/quiz.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/ebda61e3fa.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
        .hide-question {
            display: none;
        }

        .result-box {
            display: none;
            text-align: center;
            margin-top: 50px;
        }

        .result-box.show-result {
            display: block;
        }

        a {
            text-decoration: none !important;
        }
    </style>
</head>

<body>
    <audio id="bg-music" src="/audio/game-theme.mp3" autoplay loop hidden></audio>
    {{-- Form Nama Siswa --}}
    <div class="form-nama card bg-light bg-opacity-10 shadow p-4 border-0 rounded-4"
        style="max-width: 450px; width: 100%;">
        <div class="card-body text-center">
            <h3 class="mb-3"><i class="bi bi-person-circle me-2"></i>Selamat Datang!</h3>
            <img id="winAnimation" src="/images/1.gif" alt="Kemenangan" class="mx-auto d-block mb-4"
                style="max-width: 200px; display: none;">

            <p class="mb-4">Silakan masukkan nama kamu sebelum memulai quiz {{ $materi->judul }}</p>
            <input type="text" id="namaSiswa" class="form-control text-center rounded-pill mb-4"
                placeholder="Siapa Nama Kamu?">
            <!-- Tombol Mulai Quiz -->
            <div class="row">
                <button onclick="mulaiQuiz()" class="btn btn-primary w-100 rounded-pill py-2 fs-5">
                    Mulai Quiz <i class="bi bi-play-circle me-2"></i>
                </button>

                <!-- Tombol Kembali ke Materi -->
                <button onclick="kembaliKeMateri()" class="btn btn-danger w-100 rounded-pill py-2 fs-5 mt-2">
                    <i class="bi bi-arrow-left-circle me-2"></i>Kembali
                </button>
            </div>

        </div>
    </div>

    {{-- Kontainer Quiz --}}
    <div class="container hide-question">
        <header class="header">
            <h2>Quiz {{ $materi->judul }}</h2>
            <p class="status-time mb-0">
                <i class="bi bi-clock-history me-1"></i>
                Waktu <span class="time fw-bold">60</span>
            </p>

        </header>
        <main class="main-question">
            <div class="question"></div>
            <div class="answer-cotainer"></div>
        </main>
        <footer class="footer">
            <p><span class="first"></span> dari <span class="last"></span> Pertanyaan</p>
            <a class="next-Question" href="#"> Selanjutnya <i class="bi bi-arrow-right-circle"></i> </a>
            <a class="end-Quez" href="#"> Selesaikan Quiz <i class="bi bi-flag-fill"></i></a>
        </footer>
    </div>

    {{-- Kontainer Hasil --}}
    <div class="result-box">
        <div class="cup">
            <img class="cup-image">
        </div>
        <div class="message">
            <p class="message-text"></p>
            <p> Kamu Mendapatkan
                <span class="result-right"></span>
                Dari
                <span class="of-question"></span>
            </p>
        </div>
        <a href="#" class="restart-quez">Ulang Quiz</a>
    </div>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous">
</script>


<script>
    function kembaliKeMateri() {
        window.location.href = "{{ route('materi.show', $materi->id) }}";
    }

    let questions = {!! json_encode($questions, JSON_UNESCAPED_UNICODE) !!};

    let $ = document

    const time = $.querySelector('.time')
    const questionBox = $.querySelector('.question')
    const answerCotainer = $.querySelector('.answer-cotainer')
    const firstQuez = $.querySelector('.first')
    const lastQuez = $.querySelector('.last')
    const nextQuestion = $.querySelector('.next-Question')
    const statusTime = $.querySelector('.status-time')
    const endQuez = $.querySelector('.end-Quez')
    const restartQuez = $.querySelector('.restart-quez')
    const resultRight = $.querySelector('.result-right')
    const ofQuestion = $.querySelector('.of-question')
    const containerQuestion = $.querySelector('.container')
    const resultBox = $.querySelector('.result-box')
    const cupImage = $.querySelector('.cup-image')
    const message = $.querySelector('.message-text')


    let firstQuezCount = 1
    let lastQuezCount = 1
    let rightQuez = 0
    let timer;
    let index = 0
    let timeCount = 60

    function mulaiQuiz() {
        const nama = document.getElementById('namaSiswa').value.trim();
        if (nama === '') {
            alert('Silakan isi nama kamu dulu!');
            return;
        }

        // Simpan nama ke global
        window.namaSiswa = nama;

        document.querySelector('.form-nama').style.display = 'none';
        document.querySelector('.container').classList.remove('hide-question');
        createTemplate(questions);
    }


    function createTemplate(questions) {
        answerCotainer.innerHTML = ''
        questionBox.innerHTML = ''

        let quezTemplate = `<p>${questions[index].question}</p>`

        let answerOption = `<p class="answer">${questions[index].options[0]}</p>
    <p class="answer">${questions[index].options[1]}</p>
    <p class="answer">${questions[index].options[2]}</p>
    <p class="answer">${questions[index].options[3]}</p>
    <p class="answer">${questions[index].options[4]}</p>`

        questionBox.insertAdjacentHTML('beforeend', quezTemplate)
        answerCotainer.insertAdjacentHTML('beforeend', answerOption)

        firstQuez.innerHTML = index + 1
        lastQuez.innerHTML = questions.length

        timerContHandler()
        let answer = $.querySelectorAll('.answer')

        for (let i = 0; i < answer.length; i++) {
            answer[i].setAttribute('onclick', 'checkAnswer(this)')
        }
    }


    function checkAnswer(answer) {

        clearInterval(timer)
        let answerClick = answer.innerHTML
        let answerMain = questions[index].answer
        let allAnswerChild = answerCotainer.children.length
        nextQuestion.classList.add('show-next')

        if (answerClick === answerMain) {
            answer.classList.add('rightAnswer')
            rightQuez++
            updateScore(rightQuez)
        } else {
            answer.classList.add('noAnswer')
            for (let i = 0; i < allAnswerChild; i++) {
                if (answerCotainer.children[i].innerHTML === answerMain) {
                    answerCotainer.children[i].classList.add('rightAnswer')
                }
            }
        }
        for (let i = 0; i < allAnswerChild; i++) {
            answerCotainer.children[i].classList.add('disable')
        }
    }

    function timerContHandler() {
        timer = setInterval(function() {
            timeCount--
            time.innerHTML = timeCount

            if (timeCount < 10) {
                time.innerHTML = '0' + timeCount
            }
            if (timeCount == 0) {
                clearInterval(timer)
                statusTime.style.background = 'rgb(199, 36, 14 , .8)'
                nextQuestion.classList.add('show-next')

                let answerMain = questions[index].answer
                let allAnswerChild = answerCotainer.children.length

                for (let i = 0; i < allAnswerChild; i++) {
                    if (answerCotainer.children[i].innerHTML === answerMain) {
                        answerCotainer.children[i].classList.add('rightAnswer')
                    }
                }

                for (let i = 0; i < allAnswerChild; i++) {
                    answerCotainer.children[i].classList.add('disable')
                }

            } else {
                statusTime.style.background = 'rgb(145, 53, 250)'
            }
        }, 1000)
    }

    function nextQuestionHandler() {
        index++
        timeCount = 20

        // Cek apakah soal sudah habis
        if (index >= questions.length) {
            // Tampilkan tombol selesai
            nextQuestion.classList.remove('show-next')
            endQuez.classList.add('show-end')
            return
        }

        createTemplate(questions)
        nextQuestion.classList.remove('show-next')
    }


    function updateScore(right) {

        if (right > 6) {
            cupImage.setAttribute('src', '/images/gold.png')
            message.innerHTML = 'Hore! Selamat Yaa :)'
        } else if (right <= 6 && right > 4) {
            cupImage.setAttribute('src', '/images/silver.png')
            message.innerHTML = 'Wih Bagus'
        } else if (right <= 4 && right >= 2) {
            cupImage.setAttribute('src', '/images/bronze.png')
            message.innerHTML = 'Cukup Baik'
        } else if (right == 1) {
            cupImage.setAttribute('src', '/images/emojy.png')
            message.innerHTML = 'Yah Kurang Bagus :('
        } else {
            cupImage.setAttribute('src', '/images/emojy.png')
            message.innerHTML = 'Kamu Sama Sekali Ga Dapat Point :('
        }

        resultRight.innerHTML = rightQuez
        ofQuestion.innerHTML = questions.length

    }

    function showResultQuez() {
        containerQuestion.classList.add('hide-question')
        resultBox.classList.add('show-result')

        let nilaiAkhir = Math.round((rightQuez / questions.length) * 100);

        fetch("/quiz/submit", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    nama_siswa: window.namaSiswa,
                    materi_id: {{ $materi->id }},
                    jumlah_benar: rightQuez,
                    total_soal: questions.length,
                    nilai: nilaiAkhir
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Disimpan ke DB:", data);
            })
            .catch(error => {
                console.error("Gagal menyimpan:", error);
            });


    }


    function restartQuezHandler() {
        location.reload()
    }

    nextQuestion.addEventListener('click', nextQuestionHandler)
    endQuez.addEventListener('click', showResultQuez)
    restartQuez.addEventListener('click', restartQuezHandler)
    createTemplate(questions)
</script>

</html>
