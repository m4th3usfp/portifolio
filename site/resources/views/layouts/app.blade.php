<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matheus Pizzinato — Fullstack Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .prose a { color: #60a5fa; font-weight: 500; text-decoration: underline; text-underline-offset: 2px; }
        .prose a:hover { color: #93c5fd; }
        .prose a::after { content: " ↗"; font-size: 0.75em; }
        .prose ::selection { background: #1e40af; color: #fff; }
    </style>
</head>
<body class="bg-gray-950 text-gray-300 font-sans antialiased">

    <nav class="bg-gray-900 border-b border-gray-800 sticky top-0 z-10">
        <div class="max-w-4xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-lg font-bold text-blue-400 hover:text-blue-300">
                Matheus Pizzinato
            </a>
            <div class="flex gap-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-blue-400 transition">Início</a>
                <a href="{{ route('curriculo') }}" class="text-gray-400 hover:text-blue-400 transition">Currículo</a>
                <a href="{{ route('linkedin') }}" class="text-gray-400 hover:text-blue-400 transition">LinkedIn</a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="border-t border-gray-800 mt-16 py-6 text-center text-sm text-gray-600">
        <p>Matheus Fanuchy Pizzinato — Fullstack Developer</p>
    </footer>

</body>
</html>
