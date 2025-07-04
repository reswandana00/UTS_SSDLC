<!-- app/Views/dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gamifikasi SSDLC</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <div class="flex items-center">
                        <a href="/logout" class="text-white hover:bg-blue-700 px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">
                    Gamifikasi : Membangun Keamanan dalam Siklus Pengembangan Perangkat Lunak
                </h1>
                <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-4">
                    <p class="text-lg text-blue-700">Selamat Datang, <span class="font-semibold"><?= session('username') ?></span></p>
                    <p class="text-blue-600">Role: <?= session('role') ?></p>
                    <p class="text-blue-600">Akses berlaku sampai: <?= session('access_expires') ?></p>
                </div>
            </div>

            <!-- Quiz Levels -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Level 1: Basic SSDLC</h3>
                        <?php if (session('quiz_level1_complete')): ?>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completed</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-600 mb-4">Pelajari dasar-dasar keamanan dalam pengembangan perangkat lunak.</p>
                    <?php if (session('quiz_level1_complete')): ?>
                        <p class="text-sm text-gray-500 mb-4">Score: <?= session('quiz_level1_score') ?>%</p>
                    <?php endif; ?>
                    <a href="/quiz" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        <?= session('quiz_level1_complete') ? 'Retake Quiz' : 'Start Quiz' ?>
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-md relative">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-gray-900">Level 2: Cross-Site Scripting (XSS)</h3>
                        <?php if (!session('quiz_level1_complete')): ?>
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Locked</span>
                        <?php elseif (session('quiz_level2_complete')): ?>
                            <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Completed</span>
                        <?php endif; ?>
                    </div>
                    <p class="text-gray-600 mb-4">Pelajari tentang keamanan XSS dan cara pencegahannya.</p>
                    <?php if (session('quiz_level2_complete')): ?>
                        <p class="text-sm text-gray-500 mb-4">Score: <?= session('quiz_level2_score') ?>%</p>
                    <?php endif; ?>
                    <?php if (!session('quiz_level1_complete')): ?>
                        <div class="absolute inset-0 bg-gray-100 bg-opacity-90 flex items-center justify-center rounded-lg">
                            <div class="text-center">
                                <svg class="w-8 h-8 text-gray-500 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <p class="text-gray-600">Complete Level 1 to unlock</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="/quiz-level2" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            <?= session('quiz_level2_complete') ? 'Retake Quiz' : 'Start Level 2' ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Learn</h3>
                    <p class="text-gray-600">Pelajari konsep keamanan dalam pengembangan perangkat lunak.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl hover:shadow-blue-100 transition-all duration-300 cursor-pointer relative group" onclick="window.location.href='/hidden-quiz'">
                    <div class="absolute inset-0 bg-blue-500 opacity-0 group-hover:opacity-10 rounded-lg transition-opacity duration-300"></div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Practice</h3>
                    <p class="text-gray-600">Latihan dan implementasi konsep keamanan secara langsung.</p>
                    <div class="absolute -bottom-1 left-0 right-0 h-1 bg-blue-500 opacity-0 group-hover:opacity-100 rounded-b-lg transition-opacity duration-300"></div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Achieve</h3>
                    <p class="text-gray-600">Dapatkan penghargaan dan sertifikasi atas pencapaian Anda.</p>
                </div>
            </div>

            <!-- Feedback Button -->
            <div class="text-center mt-8">
                <a href="/feedback" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                    Berikan Tanggapan Anda
                </a>
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
</body>
</html>
