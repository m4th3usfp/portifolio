<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use League\CommonMark\CommonMarkConverter;

class ConteudoService
{
    private string $basePath;
    private CommonMarkConverter $markdown;

    public function __construct()
    {
        $this->basePath = realpath(__DIR__ . '/../../../content') ?: base_path('../../content');
        $this->markdown = new CommonMarkConverter();
    }

    public function sections(): array
    {
        return [
            'o-que-eu-resolvo' => 'O que eu resolvo',
            'jornada' => 'Minha Jornada',
            'mais-sobre-mim' => 'Mais sobre mim',
            'o-que-ja-fiz' => 'O que já fiz',
        ];
    }

    public function profundidades(): array
    {
        return [
            'resumo' => 'Resumo',
            'artigo' => 'Artigo',
            'completo' => 'Completo',
        ];
    }

    public function getMarkdown(string $section, string $depth): ?string
    {
        $path = "{$this->basePath}/site/{$section}/{$depth}.md";

        if (!File::exists($path)) {
            return null;
        }

        return File::get($path);
    }

    public function getHtml(string $section, string $depth): ?string
    {
        $markdown = $this->getMarkdown($section, $depth);

        if ($markdown === null) {
            return null;
        }

        return $this->markdown->convert($markdown)->getContent();
    }

    public function getRoteiro(string $section): ?string
    {
        $path = "{$this->basePath}/site/{$section}/roteiro-video.md";

        if (!File::exists($path)) {
            return null;
        }

        $markdown = File::get($path);

        return $this->markdown->convert($markdown)->getContent();
    }

    public function getCurriculoContent(): array
    {
        $files = [
            'dados-pessoais' => 'Dados Pessoais',
            'resumo-profissional' => 'Resumo Profissional',
            'habilidades' => 'Habilidades',
            'projetos' => 'Projetos em Destaque',
            'experiencias' => 'Experiências',
            'formacao' => 'Formação',
        ];

        $content = [];

        foreach ($files as $key => $title) {
            $path = "{$this->basePath}/curriculo/{$key}.md";

            if (File::exists($path)) {
                $content[] = [
                    'title' => $title,
                    'html' => $this->markdown->convert(File::get($path))->getContent(),
                ];
            }
        }

        return $content;
    }

    public function getLinkedinContent(): array
    {
        $files = [
            'sobre' => 'Sobre',
            'experiencias' => 'Experiências',
            'habilidades' => 'Habilidades',
        ];

        $content = [];

        foreach ($files as $key => $title) {
            $path = "{$this->basePath}/linkedin/{$key}.md";

            if (File::exists($path)) {
                $content[] = [
                    'title' => $title,
                    'html' => $this->markdown->convert(File::get($path))->getContent(),
                ];
            }
        }

        return $content;
    }
}
