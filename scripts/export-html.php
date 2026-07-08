<?php

// ─── Config ────────────────────────────────────────────────────────────────
$contentDir = __DIR__ . '/../content/site';
$outputFile = __DIR__ . '/../index.html';

$sections = [
    'o-que-eu-resolvo' => 'O que eu resolvo',
    'jornada'          => 'Minha Jornada',
    'mais-sobre-mim'   => 'Mais sobre mim',
    'o-que-ja-fiz'     => 'O que já fiz',
];

$depths = ['resumo', 'artigo', 'completo'];
$depthLabels = [
    'resumo'  => 'Resumo',
    'artigo'  => 'Artigo',
    'completo'=> 'Completo',
];

// ─── Simple Markdown → HTML ────────────────────────────────────────────────
function mdToHtml(string $text): string
{
    $text = str_replace(["\r\n", "\r"], "\n", $text);

    $blocks = preg_split('/\n{2,}/', $text);
    $html = '';

    foreach ($blocks as $block) {
        $block = trim($block);
        if ($block === '') continue;

        // Horizontal rule
        if (preg_match('/^-{3,}\s*$/', $block)) {
            $html .= '<hr>';
            continue;
        }

        // Headers — may have content after the title
        if (preg_match('/^(#{1,6})\s+(.+)$/m', $block, $m)) {
            $level = strlen($m[1]);
            $content = inlineMd($m[2]);
            $html .= "<h{$level}>{$content}</h{$level}>";
            // Remaining lines after the header
            $rest = preg_replace('/^#{1,6}\s+.+$/m', '', $block, 1);
            $rest = trim($rest);
            if ($rest !== '') {
                $html .= mdToHtml($rest);
            }
            continue;
        }

        // Table
        if (strpos($block, '|') !== false && isTableBlock($block)) {
            $html .= parseTable($block);
            continue;
        }

        // Unordered list
        if (preg_match('/^[\s]*[-*+]\s+/m', $block)) {
            $html .= parseList($block, 'ul');
            continue;
        }

        // Ordered list
        if (preg_match('/^[\s]*\d+\.\s+/m', $block)) {
            $html .= parseList($block, 'ol');
            continue;
        }

        // Paragraph
        $html .= '<p>' . inlineMd($block) . '</p>';
    }

    return $html;
}

function isTableBlock(string $block): bool
{
    $lines = explode("\n", trim($block));
    $pipeCount = 0;
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') continue;
        if ($line[0] !== '|') return false;
        $pipeCount = max($pipeCount, substr_count($line, '|'));
    }
    return $pipeCount >= 3; // at least 2 columns (3 pipes including edges)
}

function inlineMd(string $text): string
{
    // Bold
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    // Italic
    $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
    // Links
    $text = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2">$1</a>', $text);
    // Line breaks within paragraph
    $text = nl2br($text, false);
    return $text;
}

function parseList(string $block, string $type): string
{
    $lines = explode("\n", $block);
    $html = "<{$type}>";
    foreach ($lines as $line) {
        if (preg_match('/^[\s]*[-*+]\s+(.+)$/', $line, $m)) {
            $html .= '<li>' . inlineMd($m[1]) . '</li>';
        } elseif (preg_match('/^[\s]*\d+\.\s+(.+)$/', $line, $m)) {
            $html .= '<li>' . inlineMd($m[1]) . '</li>';
        }
    }
    $html .= "</{$type}>";
    return $html;
}

function isSeparatorRow(string $line): bool
{
    $cells = explode('|', trim($line, '|'));
    foreach ($cells as $cell) {
        $cell = trim($cell);
        if ($cell === '') continue;
        if (!preg_match('/^[\s\-:]+$/', $cell)) return false;
    }
    return true;
}

function parseTable(string $block): string
{
    $lines = explode("\n", trim($block));
    $html = '<div class="table-wrap"><table>';

    $headerDone = false;
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] !== '|') continue;

        if (isSeparatorRow($line)) continue;

        $cells = explode('|', trim($line, '|'));
        $cells = array_map(fn($c) => inlineMd(trim($c)), $cells);

        if (!$headerDone) {
            $html .= '<thead><tr>';
            foreach ($cells as $cell) {
                $html .= "<th>{$cell}</th>";
            }
            $html .= '</tr></thead><tbody>';
            $headerDone = true;
        } else {
            $html .= '<tr>';
            foreach ($cells as $cell) {
                $html .= "<td>{$cell}</td>";
            }
            $html .= '</tr>';
        }
    }

    $html .= '</tbody></table></div>';
    return $html;
}

// ─── Load content ──────────────────────────────────────────────────────────
$content = [];

foreach ($sections as $slug => $label) {
    $dir = "{$contentDir}/{$slug}";
    $sectionData = [];
    foreach ($depths as $depth) {
        $file = "{$dir}/{$depth}.md";
        if (file_exists($file)) {
            $raw = file_get_contents($file);
            // Remove first H1 (used as section title, we already have it)
            $raw = preg_replace('/^#\s+.+$/m', '', $raw, 1);
            $sectionData[$depth] = trim($raw);
        }
    }
    $content[$slug] = $sectionData;
}

// ─── Build sections HTML ───────────────────────────────────────────────────
$sectionsHtml = '';
$navItems = '';
$first = true;

foreach ($sections as $slug => $label) {
    $active = $first ? ' active' : '';
    $navItems .= "<button class=\"nav-tab{$active}\" data-section=\"{$slug}\">{$label}</button>";

    $depthsHtml = '';
    foreach ($depths as $depth) {
        if (empty($content[$slug][$depth])) continue;
        $dActive = $depth === 'resumo' ? ' active' : '';
        $converted = mdToHtml($content[$slug][$depth]);
        $depthsHtml .= "<div class=\"depth-content{$dActive}\" data-depth=\"{$depth}\">{$converted}</div>";
    }

    $depthTabs = '';
    foreach ($depths as $depth) {
        if (empty($content[$slug][$depth])) continue;
        $dActive = $depth === 'resumo' ? ' active' : '';
        $depthTabs .= "<button class=\"depth-tab{$dActive}\" data-depth=\"{$depth}\">{$depthLabels[$depth]}</button>";
    }

    $sectionsHtml .= <<<HTML
<article id="section-{$slug}" class="section{$active}">
  <div class="depth-tabs">{$depthTabs}</div>
  {$depthsHtml}
</article>
HTML;

    $first = false;
}

// ─── Build full HTML ───────────────────────────────────────────────────────
$html = <<<HTML
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Matheus Pizzinato — Desenvolvedor Fullstack</title>
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
  font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,Cantarell,sans-serif;
  background:#030712;color:#e2e8f0;line-height:1.7;
  min-height:100vh
}
a{color:#60a5fa;text-decoration:none;transition:color .2s}
a:hover{color:#93c5fd;text-decoration:underline}
strong{color:#f1f5f9}
em{color:#94a3b8}
hr{border:none;border-top:1px solid #1e293b;margin:2rem 0}

h1{font-size:1.75rem;color:#f1f5f9;margin-bottom:1rem}
h2{font-size:1.35rem;color:#e2e8f0;margin:1.5rem 0 .75rem}
h3{font-size:1.1rem;color:#cbd5e1;margin:1.25rem 0 .5rem}
h4{font-size:1rem;color:#94a3b8;margin:1rem 0 .5rem}

p{margin-bottom:1rem}
ul,ol{margin-bottom:1rem;padding-left:1.5rem}
li{margin-bottom:.35rem}
code{background:#1e293b;padding:.125rem .375rem;border-radius:4px;font-size:.9em;color:#93c5fd}

.table-wrap{overflow-x:auto;margin-bottom:1rem}
table{width:100%;border-collapse:collapse;font-size:.9rem}
th,td{padding:.5rem .75rem;text-align:left;border:1px solid #1e293b;vertical-align:top}
th{background:#0f172a;color:#94a3b8;font-weight:600;white-space:nowrap}
td{background:#111827}

/* Layout */
.container{max-width:900px;margin:0 auto;padding:2rem 1.5rem}

/* Hero */
.hero{text-align:center;padding:3rem 1.5rem 2rem}
.hero h1{font-size:2rem;margin:0}
.hero .subtitle{color:#94a3b8;font-size:1.1rem;margin-top:.5rem}
.hero .links{margin-top:1.25rem;display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
.hero .links a{
  display:inline-flex;align-items:center;gap:.5rem;
  padding:.5rem 1.25rem;border:1px solid #334155;border-radius:8px;
  font-size:.9rem;color:#e2e8f0;text-decoration:none;transition:all .25s
}
.hero .links a:hover{
  transform:translateY(-4px);box-shadow:0 10px 50px -8px rgba(96,165,250,.5);border-color:#60a5fa;text-decoration:none
}
.hero .links a .icon{font-size:1.15rem}

/* Nav */
.nav{display:flex;gap:.5rem;justify-content:center;flex-wrap:wrap;margin-bottom:2rem}
.nav-tab{
  padding:.6rem 1.25rem;border:1px solid #334155;border-radius:8px;
  background:transparent;color:#94a3b8;cursor:pointer;font-size:.9rem;font-weight:500;
  transition:all .25s;font-family:inherit
}
.nav-tab.active{border-color:#60a5fa;color:#60a5fa;box-shadow:0 0 0 1px #60a5fa}
.nav-tab:hover:not(.active){border-color:#475569;color:#e2e8f0;transform:translateY(-2px)}

/* Sections */
.section{display:none}
.section.active{display:block}

/* Depth tabs */
.depth-tabs{display:flex;gap:.35rem;margin-bottom:1.25rem}
.depth-tab{
  padding:.35rem .85rem;border:1px solid #334155;border-radius:6px;
  background:transparent;color:#64748b;cursor:pointer;font-size:.8rem;
  transition:all .25s;font-family:inherit
}
.depth-tab.active{border-color:#34d399;color:#34d399;box-shadow:0 0 0 1px #34d399}
.depth-tab:hover:not(.active){border-color:#475569;color:#94a3b8}

.depth-content{display:none}
.depth-content.active{display:block}
.depth-content h1{display:none}

/* Footer */
footer{text-align:center;padding:2rem 1.5rem;color:#475569;font-size:.85rem}

@media(max-width:640px){
  .container{padding:1rem}
  .hero{padding:2rem 1rem}
  .hero h1{font-size:1.5rem}
  .nav{gap:.35rem}
  .nav-tab{font-size:.8rem;padding:.45rem .85rem}
}
</style>
</head>
<body>

<header class="hero">
  <h1>Matheus Pizzinato</h1>
  <p class="subtitle">Desenvolvedor Fullstack &bull; Laravel &bull; PHP &bull; PostgreSQL &bull; Docker</p>
  <div class="links">
    <a href="https://github.com/m4th3usfp" target="_blank" rel="noopener">
      <span class="icon">&#128279;</span> GitHub
    </a>
    <a href="https://github.com/m4th3usfp/pescador" target="_blank" rel="noopener">
      <span class="icon">&#128279;</span> Pescador
    </a>
    <a href="https://linkedin.com/in/matheus-pizzinato" target="_blank" rel="noopener">
      <span class="icon">&#128279;</span> LinkedIn
    </a>
    <a href="/curriculo-matheus-pizzinato.pdf" target="_blank" rel="noopener">
      <span class="icon">&#128196;</span> Currículo
    </a>
  </div>
</header>

<nav class="nav" aria-label="Navegação principal">
  {$navItems}
</nav>

<main class="container">
  {$sectionsHtml}
</main>

<footer>
  &copy; 2025 Matheus Pizzinato &mdash; Feito com PHP, paciência e café
</footer>

<script>
(function(){
  // Section navigation
  const navTabs = document.querySelectorAll('.nav-tab');
  const sections = document.querySelectorAll('.section');

  function showSection(slug) {
    navTabs.forEach(t => t.classList.toggle('active', t.dataset.section === slug));
    sections.forEach(s => s.classList.toggle('active', s.id === 'section-' + slug));
  }

  navTabs.forEach(tab => {
    tab.addEventListener('click', () => showSection(tab.dataset.section));
  });

  // Depth navigation within each section
  document.querySelectorAll('.depth-tabs').forEach(tabGroup => {
    const parent = tabGroup.parentElement;
    const tabs = tabGroup.querySelectorAll('.depth-tab');
    const contents = parent.querySelectorAll('.depth-content');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        const target = parent.querySelector('.depth-content[data-depth="' + tab.dataset.depth + '"]');
        if (target) target.classList.add('active');
      });
    });
  });

  // Show first section by default
  if (navTabs.length > 0) {
    showSection(navTabs[0].dataset.section);
  }

  // Copy LinkedIn link
  const linkedinBtn = document.querySelector('a[href*="linkedin"]');
  if (linkedinBtn) {
    linkedinBtn.addEventListener('click', function(e) {
      e.preventDefault();
      navigator.clipboard.writeText(this.href).then(() => {
        const orig = this.innerHTML;
        this.innerHTML = '<span class="icon">&#10003;</span> Copiado!';
        setTimeout(() => this.innerHTML = orig, 2000);
      }).catch(() => {
        window.open(this.href, '_blank');
      });
    });
  }
})();
</script>

</body>
</html>
HTML;

file_put_contents($outputFile, $html);
echo "✓ index.html gerado com sucesso em {$outputFile}\n";
echo "  Seções: " . implode(', ', array_keys($sections)) . "\n";
echo "  Profundidades: " . implode(', ', $depths) . "\n";
