@extends('layouts.app')

@section('content')

    <a href="{{ route('home') }}" class="text-sm text-blue-400 hover:text-blue-300 mb-4 inline-block">← Voltar</a>

    <h1 class="text-3xl font-bold text-gray-100 mb-6">Currículo</h1>

    @foreach ($curriculo as $item)
        <section class="mb-6 bg-gray-900 p-6 rounded-lg border border-gray-800">
            <h2 class="text-xl font-semibold text-blue-400 mb-3">{{ $item['title'] }}</h2>
            <div class="prose prose-invert max-w-none">
                {!! $item['html'] !!}
            </div>
        </section>
    @endforeach

    <div class="text-center mt-8">
        <p class="text-sm text-gray-600">
            Para gerar o PDF, execute o script em <code class="bg-gray-800 px-1 rounded text-gray-400">scripts/gerar-curriculo.php</code>
        </p>
    </div>

@endsection
