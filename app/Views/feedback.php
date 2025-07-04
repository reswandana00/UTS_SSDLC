<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapan Anda</title>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Tanggapan Anda</h1>
                
                <form id="feedbackForm" class="space-y-4">
                    <div>
                        <label for="feedback" class="block text-sm font-medium text-gray-700">Berikan Tanggapan:</label>
                        <textarea id="feedback" name="feedback" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">
                        Submit Tanggapan
                    </button>
                </form>

                <div id="feedbackList" class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Tanggapan Sebelumnya:</h2>
                    <div id="feedbackContainer" class="space-y-4">
                        <!-- Feedback items will be added here -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const feedback = document.getElementById('feedback').value;
            
            // Intentionally vulnerable to XSS
            const feedbackContainer = document.getElementById('feedbackContainer');
            const feedbackItem = document.createElement('div');
            feedbackItem.className = 'p-4 bg-gray-50 rounded-lg';
            feedbackItem.innerHTML = feedback; // Vulnerable to XSS
            feedbackContainer.prepend(feedbackItem);
            
            // Clear the form
            document.getElementById('feedback').value = '';

            // Check if XSS alert was triggered
            if (feedback.toLowerCase().includes('alert')) {
                setTimeout(() => {
                    alert('Selamat anda telah menyelesaikan hidden quiz. ini flag anda\nSSDLC{kerawanan_xss_berbahaya}');
                }, 500);
            }
        });
    </script>
</body>
</html> 