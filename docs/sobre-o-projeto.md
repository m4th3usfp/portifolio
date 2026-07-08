# Sobre o Projeto — Portfólio Matheus Pizzinato

## Visão Geral

Portfólio profissional de Matheus Fanuchy Pizzinato, desenvolvido como vitrine para buscar oportunidades como desenvolvedor fullstack.

**3 outputs principais:**
1. Site Laravel com conteúdo em profundidade
2. Currículo em PDF gerado por script
3. Textos prontos para LinkedIn

**Três seções de conteúdo, três profundidades, dois formatos de mídia:**

```
Seções:         O que eu resolvo  |  O que já fiz  |  Mais sobre mim
Profundidades:  Resumo (10s)      |  Artigo (3min) |  Completo (10min+)
Mídia:          Texto             |  Vídeo (roteiro)
```

---

## Arquitetura

### Princípio: conteúdo separado do código

Todo o conteúdo fica em **arquivos markdown** em `content/`. O site Laravel lê esses arquivos e renderiza como HTML. Isso significa que:

- O conteúdo pode ser editado sem mexer em código
- Um redator poderia editar os `.md` sem conhecer Laravel
- O mesmo conteúdo pode ser reaproveitado em múltiplas saídas (site, PDF, LinkedIn)

### Fluxo de dados

```
content/site/o-que-eu-resolvo/resumo.md
  └─► ConteudoService::getHtml('o-que-eu-resolvo', 'resumo')
        ├─► lê o arquivo markdown
        ├─► converte para HTML (CommonMark)
        └─► retorna string HTML

PortfolioController::secao('o-que-eu-resolvo', 'resumo')
  ├─► chama ConteudoService
  ├─► passa HTML + metadados pra view
  └─► renderiza secao.blade.php
```

### Por que Laravel?

- Tecnologia que Matheus domina e quer usar profissionalmente
- `Str::markdown()` / CommonMark para converter markdown em HTML
- Blade para templates com herança e componentes
- Facilidade para evoluir: adicionar banco, autenticação, painel admin
- Domínio comprovado no projeto Pescador IA

### Por que markdown para o conteúdo?

- Formato universal, editável em qualquer editor
- Versionável com Git (diff legível)
- Fácil de converter para HTML, PDF ou outros formatos
- Sem dependência de banco de dados para conteúdo estático

---

## Estrutura de Arquivos

```
portfolio/
│
├── content/                          ← TODO O CONTEÚDO (editável manualmente)
│   ├── site/                         ← Conteúdo do site
│   │   ├── o-que-eu-resolvo/         ← Seção 1
│   │   │   ├── resumo.md             ←   10 segundos de leitura
│   │   │   ├── artigo.md             ←   3 minutos
│   │   │   ├── completo.md           ←   10-20 minutos
│   │   │   └── roteiro-video.md      ←   Roteiro para gravação
│   │   ├── o-que-ja-fiz/             ← Seção 2 (mesma estrutura)
│   │   └── mais-sobre-mim/           ← Seção 3 (mesma estrutura)
│   ├── curriculo/                    ← Dados do currículo
│   │   ├── dados-pessoais.md
│   │   ├── resumo-profissional.md
│   │   ├── experiencias.md
│   │   ├── formacao.md
│   │   ├── habilidades.md
│   │   └── projetos.md
│   └── linkedin/                     ← Textos para LinkedIn
│       ├── sobre.md
│       ├── experiencias.md
│       └── habilidades.md
│
├── site/                             ← Projeto Laravel 13
│   ├── app/
│   │   ├── Services/
│   │   │   └── ConteudoService.php   ← Lê e converte os markdown
│   │   └── Http/Controllers/
│   │       └── PortfolioController.php
│   ├── resources/views/
│   │   ├── layouts/app.blade.php     ← Layout principal
│   │   └── paginas/
│   │       ├── home.blade.php        ← Página inicial
│   │       ├── secao.blade.php       ← Página de seção (3 profundidades)
│   │       ├── curriculo.blade.php   ← Visualização do currículo
│   │       └── linkedin.blade.php    ← Textos do LinkedIn
│   └── routes/web.php
│
├── scripts/
│   └── gerar-curriculo.php           ← Gera PDF com DomPDF
│
├── docs/
│   └── sobre-o-projeto.md            ← Este arquivo
│
├── curriculo-matheus-pizzinato.pdf   ← PDF gerado
├── Makefile                          ← Atalhos: make site / make pdf
└── README.md                         ← Instruções de uso
```

---

## Como Cada Output Funciona

### 1. Site

**Rotas:**

| URL | Controller | View |
|---|---|---|
| `/` | `home()` | `home.blade.php` |
| `/{section}` | `secao(section, 'resumo')` | `secao.blade.php` |
| `/{section}/{depth}` | `secao(section, depth)` | `secao.blade.php` |
| `/curriculo` | `curriculo()` | `curriculo.blade.php` |
| `/linkedin` | `linkedin()` | `linkedin.blade.php` |

**Navegação por profundidade:** Tabs estilizadas com Tailwind. A profundiade ativa fica destacada em azul, as demais em cinza.

**Roteiro de vídeo:** Fica escondido num `<details>` amarelo na página — visível apenas se o arquivo `roteiro-video.md` existir.

### 2. Currículo PDF

O script `scripts/gerar-curriculo.php`:
1. Lê os 6 arquivos markdown de `content/curriculo/`
2. Remove o título `# Nome` de cada um (o título é adicionado manualmente)
3. Converte para HTML com CommonMark
4. Monta um HTML completo com CSS para impressão
5. Renderiza com DomPDF
6. Salva como `curriculo-matheus-pizzinato.pdf`

### 3. Textos LinkedIn

Arquivos markdown em `content/linkedin/` com botão "Copiar" que usa `navigator.clipboard.writeText()` para copiar o conteúdo para a área de transferência.

---

## Decisões Técnicas

| Decisão | Alternativa | Por que essa |
|---|---|---|
| Markdown para conteúdo | Banco de dados | Conteúdo editável sem ferramenta, versionável, portável |
| CommonMark | Parsers manuais | Padrão, confiável, já integrado ao ecossistema Laravel |
| Tailwind via CDN | Build com Vite | Zero configuração, rápido, adequado pra site estático |
| DomPDF | Laravel DomPDF / Snappy | Biblioteca standalone, não precisa do Laravel pra rodar o script |
| Sessão em arquivo | Banco SQLite | Site não precisa de banco, evita dependência de driver SQLite |
| ConteúdoService | Repository / banco | Serviço simples que encapsula leitura de arquivos e conversão |

---

## Passo a Passo da Construção

1. **Planejamento** — definição dos 3 outputs, 3 seções, 3 profundidades, 2 mídias
2. **Estrutura de pastas** — `content/site/*`, `content/curriculo`, `content/linkedin`, `site/`, `scripts/`
3. **Conteúdo** — escrita dos arquivos markdown para cada seção e profundidade, com perguntas ao Matheus sobre experiência, tecnologias, formação e perfil pessoal
4. **Laravel** — `composer create-project`, instalação de `league/commonmark`
5. **Services** — `ConteudoService` com métodos para ler markdown, converter para HTML, buscar roteiros, montar currículo e LinkedIn
6. **Controllers** — `PortfolioController` com 4 métodos (home, secao, curriculo, linkedin)
7. **Routes** — 5 rotas GET
8. **Views** — layout com Tailwind, home com cards, seção com navegação por profundidade, currículo como visualização web, LinkedIn com botão copiar
9. **PDF** — script standalone com DomPDF lendo os mesmos markdowns
10. **README + Makefile + docs** — documentação final

---

## Como Editar

### Conteúdo

Edite os arquivos em `content/` com qualquer editor de texto.

```markdown
# Título da seção

Parágrafo normal.

## Subtítulo

- Lista item 1
- Lista item 2
```

### Estilo do site

O CSS é Tailwind aplicado diretamente nas views Blade. Para mudar cores, espaçamentos, etc., edite os arquivos em `resources/views/`.

### Adicionar nova seção

1. Criar pasta em `content/site/nova-secao/`
2. Criar `resumo.md`, `artigo.md`, `completo.md` e opcionalmente `roteiro-video.md`
3. Adicionar no array `sections()` do `ConteudoService.php`
4. Adicionar card na `home.blade.php`

---

## Tecnologias Utilizadas

| Tecnologia | Versão | Uso |
|---|---|---|
| PHP | 8.3 | Linguagem principal |
| Laravel | 13 | Framework web |
| Tailwind CSS | 3+ | Estilização (via CDN) |
| league/commonmark | 2.8 | Markdown → HTML |
| dompdf/dompdf | 3.1 | Geração de PDF |
| Blade | — | Template engine |
