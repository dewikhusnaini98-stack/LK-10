<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-600 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8">

        <!-- HEADER -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Secure Login</h1>
            <p class="text-gray-500 text-sm mt-1">
                Masuk menggunakan WorkOS Authentication
            </p>
        </div>

        <div class="flex justify-center mb-6">
            <div class="bg-indigo-100 p-4 rounded-full text-2xl">
                🔐
            </div>
        </div>

        <a href="{{ route('login.workos') }}"
           class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition shadow">

            Continue with WorkOS
        </a>

        <!-- DIVIDER -->
        <div class="my-6 flex items-center gap-3">
            <hr class="flex-1 border-gray-300">
            <span class="text-xs text-gray-400">secure login</span>
            <hr class="flex-1 border-gray-300">
        </div>

        <!-- INFO -->
        <div class="bg-gray-50 rounded-xl p-3 text-xs text-gray-600 text-center">
            Login aman menggunakan WorkOS (Google / SSO / Enterprise)
        </div>

        <!-- FOOTER -->
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Secure System
        </p>

    </div>

</body>
</html>