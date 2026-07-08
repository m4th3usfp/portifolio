@extends('layouts.app')

@section('content')

    <a href="{{ route('home') }}" class="text-sm text-blue-400 hover:text-blue-300 mb-4 inline-block">← Voltar</a>

    <h1 class="text-3xl font-bold text-gray-100 mb-2">{{ $sectionTitle }}</h1>

    <div class="flex gap-2 mb-6 text-sm">
        @foreach ($profundidades as $key => $label)
            <a href="{{ route('secao.profundidade', [$section, $key]) }}"
               class="px-4 py-1.5 rounded-full border transition-all duration-200
               {{ $depth === $key
                   ? 'border-blue-500 text-blue-400 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/40'
                    : 'border-gray-700 text-gray-400 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-gray-700/50' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <article class="prose prose-invert max-w-none bg-gray-900 p-6 rounded-lg border border-gray-800">
        {!! $html !!}
    </article>

    @if ($section === 'jornada')
        <div class="grid md:grid-cols-3 gap-4 mt-8">
            <a href="https://github.com/m4th3usfp" target="_blank"
               class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-gray-600 hover:shadow-lg transition text-center">
                <h3 class="text-lg font-semibold text-gray-200">📦 GitHub</h3>
                <p class="text-sm text-gray-500 mt-1">github.com/m4th3usfp</p>
            </a>
            <a href="https://github.com/m4th3usfp/pescador" target="_blank"
               class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-emerald-500 hover:shadow-lg hover:shadow-emerald-500/5 transition text-center">
                <h3 class="text-lg font-semibold text-emerald-400">🎣 Pescador</h3>
                <p class="text-sm text-gray-500 mt-1">Repositório principal</p>
            </a>
            <a href="{{ asset('curriculo-matheus-pizzinato.pdf') }}" target="_blank"
               class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-blue-500 hover:shadow-lg hover:shadow-blue-500/5 transition text-center">
                <h3 class="text-lg font-semibold text-blue-400">📄 Currículo</h3>
                <p class="text-sm text-gray-500 mt-1">Baixar PDF</p>
            </a>
        </div>
    @endif

    @if ($roteiro)
        <details class="mt-8 bg-yellow-900/20 border border-yellow-700/30 rounded-lg p-4">
            <summary class="font-semibold text-yellow-400 cursor-pointer">🎬 Roteiro para vídeo</summary>
            <div class="mt-4 prose prose-sm prose-invert max-w-none text-yellow-200">
                {!! $roteiro !!}
            </div>
        </details>
    @endif

@endsection
