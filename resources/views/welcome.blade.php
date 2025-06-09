<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel Acadêmico') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Hero Section with Gradient Background for Trust and Growth -->
    <header class="relative bg-gradient-to-br from-blue-700 to-teal-500 h-screen flex items-center justify-center">
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
        <!-- Navigation -->
        <nav class="absolute top-0 left-0 right-0 p-6 flex justify-between items-center">
            <a href="/" class="text-white text-2xl font-bold">{{ config('app.name') }}</a>
            <div class="space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="text-white hover:underline">Registrar</a>
                @else
                    <a href="{{ route('dashboard') }}" class="text-white hover:underline">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-white hover:underline">Logout</button>
                    </form>
                @endguest
            </div>
        </nav>

        <!-- Main Hero Content -->
        <div class="relative z-10 text-center px-4">
            <h1 class="text-6xl font-extrabold text-white drop-shadow-lg mb-4">{{ config('app.name', 'Laravel Acadêmico') }}</h1>
            <p class="text-xl text-teal-200 mb-8 max-w-3xl mx-auto">Gerencie equipes, submeta trabalhos e colabore em versões com comentários integrados.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}" class="px-8 py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-lg font-semibold transition">Login</a>
                <a href="{{ route('register') }}" class="px-8 py-3 bg-orange-500 hover:bg-orange-400 text-white rounded-lg font-semibold transition">Registrar</a>
            </div>
        </div>
    </header>

    <!-- Features Section with Soft White Background for Clarity -->
    <main class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Textual Features -->
            <div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-6">Funcionalidades Principais</h2>
                <ul class="space-y-6 text-gray-700 dark:text-gray-300">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-blue-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927C9.349 2.364 10.651 2.364 10.951 2.927l.708 1.438a1 1 0 00.95.691h1.513c.637 0 .955.781.517 1.179l-1.225 1.054a1 1 0 00-.293.894l.306 1.48c.137.663-.586 1.161-1.164.847l-1.357-.784a1 1 0 00-.931 0l-1.357.784c-.578.314-1.301-.184-1.164-.847l.306-1.48a1 1 0 00-.293-.894L2.96 6.235c-.438-.398-.12-1.179.517-1.179h1.513a1 1 0 00.95-.691l.708-1.438z"/></svg>
                        Gerenciamento de equipes com convites exclusivos
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M4 3a1 1 0 000 2h12a1 1 0 100-2H4zM3 7a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 11a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"/></svg>
                        Submissão de trabalhos com uploads múltiplos
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm3.707 5.707a1 1 0 00-1.414-1.414L9 9.586 7.707 8.293a1 1 0 00-1.414 1.414L9 12.414l4.707-4.707z" clip-rule="evenodd"/></svg>
                        Controle de versões com histórico detalhado
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-red-500 mr-4" fill="currentColor" viewBox="0 0 20 20"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zm2-3a2 2 0 11-4 0 2 2 0 014 0z"/><path fill-rule="evenodd" d="M2 13a6 6 0 0112 0v1H2v-1zm14 1v-1a6 6 0 10-12 0v1a2 2 0 002 2h8a2 2 0 002-2z" clip-rule="evenodd"/></svg>
                        Comentários colaborativos para revisão rápida
                    </li>
                </ul>
            </div>
            <!-- Illustrative Image -->
            <div>
                <img src="https://source.unsplash.com/600x400/?teamwork,education" alt="Colaboração" class="w-full rounded-lg shadow-lg border-4 border-blue-200">
            </div>
        </div>
    </main>

    <!-- Footer with Trust Seal Colors -->
    <footer class="bg-gradient-to-t from-gray-100 to-teal-100 dark:from-gray-800 dark:to-teal-900 text-center py-6">
        <p class="text-gray-700 dark:text-gray-300 text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
