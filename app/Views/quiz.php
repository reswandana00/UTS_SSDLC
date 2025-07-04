<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSDLC Quiz</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Navigation Bar -->
        <nav class="bg-blue-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <span class="text-white text-xl font-bold">SSDLC Gamifikasi</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="/dashboard" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="/logout" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">SSDLC Quiz</h1>
                <div id="quiz-container">
                    <!-- Questions will be dynamically loaded here -->
                </div>
            </div>
        </main>
    </div>

    <script>
        const questions = [
            {
                question: "Apa perbedaan utama antara Software Security dan Application Security menurut McGraw?",
                options: [
                    "Software Security dilakukan setelah perangkat lunak selesai dibuat, sedangkan Application Security dilakukan saat proses pengembangan",
                    "Software Security menekankan post-facto protection, sementara Application Security membangun keamanan dari awal",
                    "Software Security membangun keamanan dari awal, sedangkan Application Security dilakukan setelah perangkat lunak disebarkan",
                    "Keduanya berarti hal yang sama dalam konteks SDLC"
                ],
                correct: 2,
                explanation: "Software Security = keamanan dari awal, Application Security = post-deployment."
            },
            {
                question: "Manakah dari berikut ini merupakan kerugian karena inadequate software testing menurut data NIST?",
                options: [
                    "$30.000 per KLOC",
                    "$500 juta",
                    "$3,3 miliar",
                    "$100 juta"
                ],
                correct: 2,
                explanation: "Data dari NIST menyebutkan kerugian besar karena kurangnya pengujian perangkat lunak yang memadai."
            },
            {
                question: "Manakah di antara fase berikut yang memberikan ROSI tertinggi saat perbaikan kerentanan dilakukan?",
                options: [
                    "Testing",
                    "Implementation",
                    "Design",
                    "Deployment"
                ],
                correct: 2,
                explanation: "Menurut studi IBM, fixing during Design menghasilkan pengembalian $21.000 per $100.000."
            },
            {
                question: "Apa fungsi utama dari Security Response Planning dalam proses akhir Secure SDLC?",
                options: [
                    "Membuat patch secara otomatis",
                    "Melakukan analisis pasar",
                    "Menyusun rencana menghadapi insiden keamanan",
                    "Mendeploy fitur keamanan baru"
                ],
                correct: 2,
                explanation: "Security Response Planning adalah tahap antisipasi dan mitigasi bila insiden terjadi."
            },
            {
                question: "Mengapa metode SSDLC kini mulai digabungkan dengan AI dan Zero Trust Architecture?",
                options: [
                    "Karena AI menggantikan semua pengembang",
                    "Karena biaya AI semakin murah",
                    "Untuk meningkatkan otomatisasi dan deteksi dini kerentanan",
                    "Karena NIST mewajibkannya"
                ],
                correct: 2,
                explanation: "SSDLC kini terintegrasi dengan AI untuk analisis statis/dinamis dan model arsitektur modern."
            },
            {
                question: "Manakah dari berikut ini yang bukan tujuan dari Secure SDLC?",
                options: [
                    "Meningkatkan keamanan secara sistematis",
                    "Menyediakan alat otomatisasi",
                    "Mempercepat proses peretasan",
                    "Memberikan panduan aktivitas aman"
                ],
                correct: 2,
                explanation: "Secure SDLC bertujuan mengurangi peretasan, bukan mempercepatnya 😄"
            }
        ];

        let currentQuestion = 0;
        const attempts = new Array(questions.length).fill(0);
        const maxAttempts = 2;

        function displayQuestion() {
            const question = questions[currentQuestion];
            let html = `
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4">Soal ${currentQuestion + 1}</h2>
                    <p class="text-lg mb-4">${question.question}</p>
                    <div class="space-y-3">
            `;

            question.options.forEach((option, index) => {
                html += `
                    <div class="flex items-center">
                        <input type="radio" id="option${index}" name="answer" value="${index}" class="h-4 w-4 text-blue-600">
                        <label for="option${index}" class="ml-2 text-gray-700">${option}</label>
                    </div>
                `;
            });

            html += `
                    </div>
                    <div class="mt-6">
                        <button onclick="checkAnswer()" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">Submit</button>
                    </div>
                </div>
            `;

            document.getElementById('quiz-container').innerHTML = html;
        }

        function checkAnswer() {
            const selectedAnswer = document.querySelector('input[name="answer"]:checked');
            
            if (!selectedAnswer) {
                Swal.fire({
                    title: 'Oops!',
                    text: 'Silakan pilih jawaban terlebih dahulu!',
                    icon: 'warning'
                });
                return;
            }

            const answerIndex = parseInt(selectedAnswer.value);
            const question = questions[currentQuestion];

            if (answerIndex === question.correct) {
                Swal.fire({
                    title: 'Benar!',
                    text: question.explanation,
                    icon: 'success'
                }).then(() => {
                    nextQuestion();
                });
            } else {
                attempts[currentQuestion]++;
                
                if (attempts[currentQuestion] >= maxAttempts) {
                    Swal.fire({
                        title: 'Jawaban Salah',
                        html: `Jawaban yang benar adalah:<br><br><strong>${question.options[question.correct]}</strong><br><br>Penjelasan: ${question.explanation}`,
                        icon: 'error'
                    }).then(() => {
                        nextQuestion();
                    });
                } else {
                    Swal.fire({
                        title: 'Jawaban Salah',
                        text: `Anda masih memiliki ${maxAttempts - attempts[currentQuestion]} kesempatan lagi.`,
                        icon: 'error'
                    });
                }
            }
        }

        function nextQuestion() {
            currentQuestion++;
            if (currentQuestion < questions.length) {
                displayQuestion();
            } else {
                showQuizComplete();
            }
        }

        function showQuizComplete() {
            const correctAnswers = attempts.filter(a => a < maxAttempts).length;
            const totalQuestions = questions.length;
            const score = Math.round((correctAnswers / totalQuestions) * 100);

            Swal.fire({
                title: 'Quiz Selesai!',
                html: `
                    <p>Skor Anda: ${score}%</p>
                    <p>Jawaban benar: ${correctAnswers} dari ${totalQuestions} soal</p>
                `,
                icon: 'info',
                confirmButtonText: 'Selesai'
            }).then(() => {
                // Save quiz completion status
                fetch('/complete-quiz', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ score: score })
                }).then(() => {
                    window.location.href = '/dashboard';
                });
            });
        }

        // Start the quiz
        displayQuestion();
    </script>
</body>
</html> 