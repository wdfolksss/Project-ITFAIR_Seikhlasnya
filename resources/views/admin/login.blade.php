<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kelawar</title>

    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <div class="text-center mb-8">
            <img src="{{ asset('img/bridge.svg') }}"
                 alt="Logo"
                 class="w-16 h-16 mx-auto mb-4">

            <h1 class="text-3xl font-bold text-gray-800">
                Hallo Admin
            </h1>

            <p class="text-gray-500 mt-2">
                Kelawar Infrastructure Monitoring
            </p>
        </div>

        <form action="" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" placeholder="admin@email.com" 
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" placeholder="••••••••" 
                class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-800 text-white font-semibold py-3 rounded-xl transition duration-300">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('homeUser') }}"
               class="text-sm text-gray-500 hover:text-blue-600">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>