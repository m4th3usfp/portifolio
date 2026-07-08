<?php

namespace App\Http\Controllers;

use App\Services\ConteudoService;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function __construct(
        private ConteudoService $conteudo
    ) {}

    public function home()
    {
        return view('paginas.home', [
            'sections' => $this->conteudo->sections(),
        ]);
    }

    public function secao(string $section, string $depth = 'resumo')
    {
        $sections = $this->conteudo->sections();

        abort_unless(isset($sections[$section]), 404);
        abort_unless(in_array($depth, ['resumo', 'artigo', 'completo']), 404);

        $html = $this->conteudo->getHtml($section, $depth);

        abort_if($html === null, 404);

        return view('paginas.secao', [
            'section' => $section,
            'sectionTitle' => $sections[$section],
            'depth' => $depth,
            'html' => $html,
            'roteiro' => $this->conteudo->getRoteiro($section),
            'profundidades' => $this->conteudo->profundidades(),
            'sections' => $sections,
        ]);
    }

    public function curriculo()
    {
        return view('paginas.curriculo', [
            'curriculo' => $this->conteudo->getCurriculoContent(),
        ]);
    }

    public function linkedin()
    {
        return view('paginas.linkedin', [
            'linkedin' => $this->conteudo->getLinkedinContent(),
        ]);
    }
}
