<?php

/**
 * Script para gerar currículo em PDF
 *
 * Uso: php scripts/gerar-curriculo.php
 *
 * Requer: composer require dompdf/dompdf
 */

require __DIR__ . '/../site/vendor/autoload.php';

use Dompdf\Dompdf;
use League\CommonMark\CommonMarkConverter;

$markdown = new CommonMarkConverter();
$basePath = __DIR__ . '/../content/curriculo';

$sections = [
    'dados-pessoais' => null, // special: rendered manually in header
    'resumo-profissional' => 'Resumo de Qualificação',
    'experiencias' => 'Experiência Profissional',
    'formacao' => 'Formação e Cursos',
    'projetos' => 'Projetos',
    'habilidades' => 'Informações Adicionais',
];

$html = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 18px 28px; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 7.5pt;
            color: #1a1a1a;
            line-height: 1.25;
        }
        .header {
            text-align: center;
            margin-bottom: 8px;
        }
        .header h1 {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14pt;
            font-weight: bold;
            color: #000;
            margin: 0 0 2px 0;
            padding-bottom: 0;
        }
        .header .subtitle {
            font-family: DejaVu Serif, serif;
            font-size: 7.5pt;
            color: #333;
            margin: 1px 0;
        }
        .header .contact {
            font-family: DejaVu Sans, sans-serif;
            font-size: 7pt;
            color: #555;
            margin: 0;
        }
        hr {
            border: none;
            border-top: 0.8px solid #333;
            margin: 3px 0 5px 0;
        }
        .section-title {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8.5pt;
            font-weight: bold;
            color: #000;
            margin: 6px 0 2px 0;
            padding: 0;
        }
        .section-content {
            font-family: DejaVu Serif, serif;
            font-size: 7.5pt;
            line-height: 1.25;
            margin-left: 0;
        }
        .section-content p {
            margin: 1pt 0;
        }
        .section-content ul {
            margin: 1pt 0;
            padding-left: 12pt;
            list-style-type: disc;
        }
        .section-content li {
            margin: 0.3pt 0;
        }
        .section-content strong {
            font-family: DejaVu Sans, sans-serif;
            font-weight: bold;
        }
        .section-content em {
            font-style: italic;
            color: #555;
            font-size: 7pt;
        }
        .section-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 2pt 0;
            font-size: 7pt;
        }
        .section-content th, .section-content td {
            border: 1px solid #ccc;
            padding: 1.5pt 3pt;
            text-align: left;
        }
        .section-content th {
            font-family: DejaVu Sans, sans-serif;
            font-weight: bold;
            background: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Matheus Fanuchy Pizzinato</h1>
        <div class="subtitle">Desenvolvedor Fullstack</div>
        <div class="contact">
            <a href="mailto:matheuspizzinato975@gmail.com">matheuspizzinato975@gmail.com</a> | <a href="tel:+5519999833188">(19) 99983-3188</a>
        </div>
        <div class="contact">
            Frutal/MG | <a href="https://github.com/m4th3usfp">github.com/m4th3usfp</a>
        </div>
    </div>
    <hr>
HTML;

foreach ($sections as $file => $title) {
    $path = "{$basePath}/{$file}.md";

    if (!file_exists($path)) {
        continue;
    }

    $content = file_get_contents($path);
    $content = preg_replace('/^# .+\n/', '', $content, 1);

    if ($title !== null) {
        $html .= '<div class="section-title">' . htmlspecialchars($title) . '</div>';
    }

    $converted = $markdown->convert($content)->getContent();

    // Wrap in section-content div
    $html .= '<div class="section-content">' . $converted . '</div>';
}

$html .= '</body></html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();

$outputPath = __DIR__ . '/../curriculo-matheus-pizzinato.pdf';
file_put_contents($outputPath, $dompdf->output());

echo "✅ Currículo gerado: {$outputPath}\n";
