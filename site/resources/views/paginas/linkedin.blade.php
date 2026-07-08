@extends('layouts.app')

@section('content')

    <a href="{{ route('home') }}" class="text-sm text-blue-400 hover:text-blue-300 mb-4 inline-block">← Voltar</a>

    <h1 class="text-3xl font-bold text-gray-100 mb-2">Textos para LinkedIn</h1>
    <p class="text-gray-500 mb-6">Copie e cole no seu perfil do LinkedIn.</p>

    @foreach ($linkedin as $item)
        <section class="mb-6 bg-gray-900 p-6 rounded-lg border border-gray-800">
            <h2 class="text-xl font-semibold text-purple-400 mb-3">{{ $item['title'] }}</h2>
            <div class="prose prose-invert max-w-none">
                {!! $item['html'] !!}
            </div>
            <button onclick="copyContent(this)"
                    class="mt-3 text-sm text-purple-400 hover:text-purple-300 border border-purple-700 px-3 py-1 rounded hover:bg-purple-900/30 transition">
                📋 Copiar
            </button>
        </section>
    @endforeach

    <script>
        function copyContent(btn) {
            const section = btn.closest('section');
            const text = section.querySelector('.prose').innerText;
            navigator.clipboard.writeText(text).then(() => {
                btn.textContent = '✅ Copiado!';
                setTimeout(() => { btn.textContent = '📋 Copiar'; }, 2000);
            });
        }
    </script>

@endsection
