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
</head>

<body>
    <div class="container">
        <header class="header">
            <h2>Quiz</h2>
            <p class="status-time">Waktu <span class="time">60</span></p>
        </header>
        <main class="main-question">
            <div class="question"></div>
            <div class="answer-cotainer"></div>
        </main>
        <footer class="footer">
            <p><span class="first"></span> dari <span class="last"></span> Pertanyaan</p>
            <a class="next-Question" href="#">Selanjutnya</a>
            <a class="end-Quez" href="#">Selesaikan Quiz</a>
        </footer>
    </div>
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

<script>
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
            message.innerHTML = 'And congrats!'
        } else if (right <= 6 && right > 4) {
            cupImage.setAttribute('src', '/images/silver.png')
            message.innerHTML = 'And nice'
        } else if (right <= 4 && right >= 2) {
            cupImage.setAttribute('src', '/images/bronze.png')
            message.innerHTML = 'And passable'
        } else if (right == 1) {
            cupImage.setAttribute('src', '/images/emojy.png')
            message.innerHTML = 'And sorry'
        } else {
            cupImage.setAttribute('src', '/images/emojy.png')
            message.innerHTML = 'You did not get any points!'
        }

        resultRight.innerHTML = rightQuez
        ofQuestion.innerHTML = questions.length

    }

    function showResultQuez() {
        containerQuestion.classList.add('hide-question')
        resultBox.classList.add('show-result')
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
