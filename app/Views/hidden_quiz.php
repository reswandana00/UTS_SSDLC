<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hidden Quiz - XSS Challenge</title>
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
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Hidden Quiz - XSS Challenge</h1>
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                    <p class="text-yellow-700">
                        Web ini memiliki kerawanan XSS coba cari dan submit flagnya kesini!!
                    </p>
                </div>
                
                <form id="flagForm" class="space-y-4">
                    <div>
                        <label for="flag" class="block text-sm font-medium text-gray-700">Submit Flag:</label>
                        <input type="text" id="flag" name="flag" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">
                        Submit Flag
                    </button>
                </form>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('flagForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const flag = document.getElementById('flag').value;
            if (flag === 'SSDLC{kerawanan_xss_berbahaya}') {
                alert('Selamat! Flag yang anda masukkan benar!');
                window.location.href = '/dashboard';
            } else {
                alert('Flag yang anda masukkan salah. Coba lagi!');
            }
        });
    </script>
</body>
</html> 