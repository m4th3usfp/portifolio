@extends('layouts.app')

@section('content')

    <div class="text-center py-12">
        <h1 class="text-4xl font-bold text-gray-100 mb-4">Matheus Fanuchy Pizzinato</h1>
        <p class="text-xl text-gray-400 mb-2">Desenvolvedor Fullstack</p>
        <p class="text-gray-500">Laravel · PHP · PostgreSQL · JavaScript · Docker</p>
    </div>

    <div class="text-center mb-8">
        <a href="{{ route('secao', 'jornada') }}"
           class="inline-block px-6 py-3 border border-blue-500 text-blue-400 rounded-lg hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/40 transition-all duration-200 font-medium">
            Minha jornada de 3 anos até aqui →
        </a>
    </div>

    <div class="grid gap-4 mt-8">
        <h2 class="text-2xl font-semibold text-gray-200 text-center mb-4">O que você quer ver?</h2>

        <div class="grid gap-4">
            <a href="{{ route('secao', 'o-que-eu-resolvo') }}"
               class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-blue-500 hover:shadow-lg hover:shadow-blue-500/5 transition text-center">
                <h3 class="text-lg font-semibold text-blue-400">O que eu resolvo</h3>
                <p class="text-sm text-gray-500 mt-2">Problemas que resolvo como desenvolvedor</p>
            </a>

            <a href="{{ route('secao', 'o-que-ja-fiz') }}"
               class="block p-8 bg-gray-900 rounded-lg border-2 border-blue-900 hover:border-blue-500 hover:shadow-lg hover:shadow-blue-500/10 transition">
                <h3 class="text-xl font-semibold text-blue-400 mb-2">O que já fiz</h3>
                <p class="text-sm text-gray-500 mb-3">Projetos, estudos e trabalhos realizados</p>
                <ul class="text-sm text-gray-400 space-y-1.5">
                    <li><span class="text-blue-400 mr-2">▸</span><strong class="text-gray-200">Pescador</strong> — sistema de gestão para colônias de pescadores</li>
                    <li><span class="text-blue-400 mr-2">▸</span><strong class="text-gray-200">Sistema de Atacado</strong> — manutenção e novas funcionalidades</li>
                    <li><span class="text-blue-400 mr-2">▸</span><strong class="text-gray-200">Freela PHP</strong> — frontend com código em produção</li>
                </ul>
                <span class="inline-block mt-4 text-blue-400 text-sm font-medium hover:text-blue-300">Ver detalhes →</span>
            </a>
        </div>

        <a href="{{ route('secao', 'mais-sobre-mim') }}"
           class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-blue-500 hover:shadow-lg hover:shadow-blue-500/5 transition text-center">
            <h3 class="text-lg font-semibold text-blue-400">Mais sobre mim</h3>
            <p class="text-sm text-gray-500 mt-2">Quem sou fora do código</p>
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-4 mt-8">
        <a href="{{ route('curriculo') }}"
           class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-emerald-500 hover:shadow-lg hover:shadow-emerald-500/5 transition text-center">
            <h3 class="text-lg font-semibold text-emerald-400">📄 Currículo</h3>
            <p class="text-sm text-gray-500 mt-2">Versão completa para download</p>
        </a>
        <a href="{{ route('linkedin') }}"
           class="block p-6 bg-gray-900 rounded-lg border border-gray-800 hover:border-purple-500 hover:shadow-lg hover:shadow-purple-500/5 transition text-center">
            <h3 class="text-lg font-semibold text-purple-400">🔗 Textos LinkedIn</h3>
            <p class="text-sm text-gray-500 mt-2">Conteúdo pronto para copiar</p>
        </a>
    </div>

@endsection
