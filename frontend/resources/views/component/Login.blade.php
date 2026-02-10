<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal Berita</title>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-[#4988C4] to-blue-900 min-h-screen flex items-center justify-center">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl p-8">

        <!-- LOGO / TITLE -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Portal Berita</h1>
            <p class="text-gray-500 mt-2">Silakan login untuk melanjutkan</p>
        </div>

        <!-- ERROR -->
        @if(session('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- FORM LOGIN -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- EMAIL -->
            <div class="mb-5">
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Email / Username
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           class="w-full pl-11 pr-4 py-3 rounded-xl border
                                  focus:ring-2 focus:ring-[#4988C4] outline-none">
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-700">
                    Password
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password"
                           name="password"
                           required
                           class="w-full pl-11 pr-4 py-3 rounded-xl border
                                  focus:ring-2 focus:ring-[#4988C4] outline-none">
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="w-full py-3 bg-[#4988C4] text-white font-semibold
                           rounded-xl shadow-lg shadow-blue-500/40
                           hover:opacity-90 transition">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </button>
        </form>

        <!-- FOOTER -->
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Portal Berita
        </p>
    </div>

</body>
</html>
