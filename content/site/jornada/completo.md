# Minha jornada até aqui — Versão completa

## O começo

Há três anos, eu não sabia o que era uma variável. Tinha 23 anos, nenhuma experiência em tecnologia, e trabalhava em empregos que não me realizavam — atendimento ao cliente, vendas, estoque. Até que decidi: quero ser desenvolvedor.

Sem faculdade, sem contatos na área, só com um notebook e disposição. Comecei pelo básico: lógica de programação, JavaScript, HTML, CSS. Cada conceito novo era um mundo. Cada "Hello World" me animava mais.

## A trilha de estudos

Foi quando encontrei o [marcelao.dev](https://marcelao.dev), uma trilha de estudos completa montada por um desenvolvedor sênior. Ali tive um norte: sabia exatamente o que estudar em cada etapa.

A trilha cobriu:

- **Lógica de programação e algoritmos**
- **PHP** — do procedural ao Orientado a Objetos
- **Laravel** — rotas, controllers, Eloquent, migrations, blade
- **Banco de dados** — modelagem, SQL, PostgreSQL, MySQL
- **Docker** — containers, docker-compose, ambiente de desenvolvimento
- **Git e GitHub** — versionamento, branches, pull requests
- **Boas práticas** — SOLID, DRY, código limpo, organização de projetos

Cada módulo tinha exercícios práticos e projetos para fixar. Não era só assistir vídeo — era codar.

## O grande projeto: Pescador

O [**Pescador**](https://github.com/m4th3usfp/pescador) foi meu divisor de águas. Um sistema real de gestão para colônias de pescadores que peguei em andamento e precisei refatorar por completo.

### O que o sistema faz

Cadastro de pescadores, geração automática de documentos (PIS, recibos, auto declaração), controle de pagamentos com QR Code PIX, backup automatizado para Cloudflare R2, auditoria de ações — tudo em uma plataforma web.

### A refatoração

O código original tinha dívida técnica severa:

| Problema | Solução |
|---|---|
| Controller de 1638 linhas | Extraído em 5 controllers |
| Autorização por nome de usuário | Sistema de roles (admin/supervisor/user) + Gates |
| `env()` no código de produção | Substituído por `config()` |
| Migration com typo | Corrigido |
| Race condition no PostgreSQL | `pg_advisory_xact_lock` |
| 22 testes quebrados | Todos corrigidos (Pest 3.x) |

### Resultado

22 testes automatizados (59 assertions), código organizado, documentado, e um cliente usando o sistema de verdade.

## Freela de frontend

Em 2023 fiz um freela de frontend PHP — site em produção com prazos reais e cliente de verdade. Aprendi na prática que código não é só sobre fazer funcionar, é sobre entregar valor sem quebrar o que já existe.

## Onde estou hoje

Atualmente tenho domínio consolidado de:

- **Backend:** Laravel, PHP 8.x, Eloquent, REST APIs, Artisan Commands, Gates/Middleware
- **Frontend:** HTML, CSS, JavaScript (ES6+), Blade
- **Banco:** PostgreSQL 17, MySQL, migrations, queries, transactions
- **Infra:** Docker, Git/GitHub, Linux
- **Cloud:** Cloudflare R2 (S3-compatible), Azure (fundamentos)
- **Testes:** Pest PHP

E estou expandindo para:

- **Java** — Spring Boot, APIs REST, ecossistema Java
- **React** — componentes, hooks, estado, integração com APIs
- **TypeScript** — tipagem estática, interfaces, generics
- **AWS** — S3, EC2, Lambda (em andamento)

## Além do código

Fora da programação, cozinho e leio sobre tecnologia e qualidade de vida. Acredito que um bom desenvolvedor não é só quem escreve código limpo — é quem se comunica bem, trabalha em equipe e entende o problema antes de resolver.

---

**Links úteis:** [GitHub](https://github.com/m4th3usfp) · [Pescador](https://github.com/m4th3usfp/pescador) · [Currículo](/curriculo-matheus-pizzinato.pdf)
