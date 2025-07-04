<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSDLC Quiz - Level 2</title>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Level 2: Cross-Site Scripting (XSS)</h1>
                <div id="quiz-container">
                    <!-- Questions will be dynamically loaded here -->
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-blue-600">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                <p class="text-center text-white">&copy; 2025 SSDLC Gamifikasi. All rights reserved.</p>
                <p class="text-center text-white text-sm mt-1">Created by Latief Reswandana</p>
            </div>
        </footer>
    </div>

    <script>
        const questions = [
            {
                question: "Apa yang dimaksud dengan Cross-Site Scripting (XSS)?",
                options: [
                    "Teknik serangan untuk mencuri data server melalui SQL",
                    "Teknik injeksi yang menyisipkan skrip jahat ke dalam situs web agar dijalankan di browser pengguna",
                    "Teknik bypass login menggunakan token",
                    "Teknik brute force terhadap form login"
                ],
                correct: 1,
                explanation: "XSS mengeksploitasi input tidak divalidasi untuk menjalankan JavaScript berbahaya di browser korban."
            },
            {
                question: "Salah satu contoh input XSS klasik yang berbahaya adalah...",
                options: [
                    "../etc/passwd",
                    "&lt;script&gt;alert('XSS')&lt;/script&gt;",
                    "SELECT * FROM users",
                    "-- DROP TABLE"
                ],
                correct: 1,
                explanation: "Ini contoh skrip yang akan dieksekusi jika tidak difilter: bisa mencuri cookie atau menipu UI."
            },
            {
                question: "Bagaimana cara paling dasar mencegah serangan XSS?",
                options: [
                    "Memblokir semua koneksi internet",
                    "Melarang penggunaan form input",
                    "Melakukan escape/encode pada input pengguna saat ditampilkan",
                    "Menyimpan input di database dengan enkripsi"
                ],
                correct: 2,
                explanation: "Gunakan HTML encoding untuk mencegah skrip dari pengguna dieksekusi."
            },
            {
                question: "Apa peran dari Secure Coding dalam mencegah XSS?",
                options: [
                    "Membatasi akses server",
                    "Menghindari pembuatan aplikasi",
                    "Menyediakan panduan dan alat agar pengembang tidak menulis kode rawan serangan",
                    "Melatih pengguna untuk mengenali XSS"
                ],
                correct: 2,
                explanation: "Secure coding policies memberikan aturan aman seperti output escaping dan input validation."
            },
            {
                question: "XSS Reflected biasanya terjadi...",
                options: [
                    "Saat data disimpan di database lalu digunakan ulang",
                    "Saat skrip langsung dikirim dan dieksekusi melalui URL",
                    "Saat pengguna men-download file JS berbahaya",
                    "Saat data dikirim dari satu situs ke situs lain"
                ],
                correct: 1,
                explanation: "Reflected XSS terjadi ketika input dari URL langsung digunakan dalam output halaman tanpa disaring."
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
                title: 'Quiz Level 2 Selesai!',
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
                    body: JSON.stringify({ score: score, level: 2 })
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