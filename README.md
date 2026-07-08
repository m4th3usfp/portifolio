# Portfólio — Matheus Pizzinato

Portfólio profissional de **Matheus Fanuchy Pizzinato**, desenvolvedor fullstack especializado em Laravel, PHP, PostgreSQL, JavaScript e Docker.

## Estrutura

```
portfolio/
├── content/                     # Conteúdo em markdown
│   ├── site/                    #   Seções do site
│   │   ├── o-que-eu-resolvo/    #     resumo, artigo, completo, roteiro-video
│   │   ├── o-que-ja-fiz/        #     idem
│   │   └── mais-sobre-mim/      #     idem
│   ├── curriculo/               #   Dados do currículo (6 arquivos)
│   └── linkedin/                #   Textos para LinkedIn (3 arquivos)
├── site/                        # Site Laravel
├── scripts/                     # Utilitários
│   └── gerar-curriculo.php      #   Gera PDF do currículo
└── README.md
```

## Como usar

### Site

```bash
cd site
php artisan serve
```

Abra http://localhost:8000

Navegue pelas seções e alterne entre as profundidades: **Resumo** (10s), **Artigo** (3min), **Completo** (10min+).

### Currículo PDF

```bash
php scripts/gerar-curriculo.php
```

Gera `curriculo-matheus-pizzinato.pdf` na raiz do projeto.

### LinkedIn

Os textos prontos estão em `content/linkedin/`. Copie e cole no seu perfil.

## Conteúdo

Cada seção do site tem 4 arquivos de conteúdo:

| Arquivo | Profundidade | Leitura |
|---|---|---|
| `resumo.md` | Resumo | 10–15 segundos |
| `artigo.md` | Artigo | ~3 minutos |
| `completo.md` | Completo | 10–20 minutos |
| `roteiro-video.md` | Roteiro | Para gravação de vídeo |

Os arquivos são markdown puro — edite manualmente quando quiser.

## Tecnologias

- **Site:** Laravel 13, Tailwind CSS, CommonMark
- **PDF:** DomPDF
- **Editor:** Qualquer editor de texto (VS Code, vim, etc.)
