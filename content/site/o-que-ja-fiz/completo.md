# O que já fiz

## Pescador IA

### Visão geral
[**Pescador**](https://github.com/m4th3usfp/pescador): sistema web completo para gestão de colônias de pescadores. Desenvolvido com **Laravel 11** e **PostgreSQL 17**, rodando em Docker. O sistema substitui processos que antes eram manuais (papel, planilhas, e-mails soltos) por uma plataforma unificada.

### Funcionalidades implementadas
- **Cadastro de pescadores** com validação de CPF, CEP, telefone, email — com proteção contra duplicatas
- **Geração de documentos**: PIS, auto declaração, recibos de anuidade — em formato Word (.docx), baixáveis individualmente ou em lote
- **Controle de pagamentos**: registro de mensalidades, status de pagamento, histórico financeiro por pescador
- **Upload de arquivos**: documentos anexados ao perfil do pescador, armazenados em Cloudflare R2 (S3-compatible)
- **Backup automatizado**: dump do PostgreSQL enviado para R2 e por email
- **Geração de QR Code PIX**: cobrança automatizada com QR Code enviado por email
- **Auditoria**: todas as ações registradas com spatie/laravel-activitylog
- **Autenticação e autorização**: sistema de roles (admin, supervisor, user) com Gates do Laravel

### Engenharia e refatoração
O projeto original tinha dívida técnica severa. As principais intervenções:

| Problema | Solução |
|---|---|
| Controller de 1638 linhas | Extraído em 5 controllers especializados |
| Autorização por nome de usuário | Sistema de roles + Gates |
| `env()` no código de produção | Substituído por `config()` |
| Migration com typo (`constrainded`) | Corrigido para `constrained` |
| Tabela `cities` criada depois de `users` | Ordem corrigida na migration |
| `getAuthPassword()` retornando coluna inexistente | Removido |
| Race condition com `lockForUpdate()` (proibido no PostgreSQL) | Substituído por `pg_advisory_xact_lock` |
| 22 testes quebrados | Todos corrigidos (Pest 3.x, session, tipos) |
| Valores hardcoded nos commands | Centralizados em `config/colony.php` |
| QR Code com URL localhost | Embutido como base64 no email |

### Tecnologias aplicadas
- **Backend:** Laravel 11, PHP 8.x, Eloquent, Commands, Events, Gates, Middleware
- **Banco:** PostgreSQL 17, migrations, transactions, advisory locks
- **Frontend:** Blade, JavaScript, HTML, CSS, formulários com validação
- **Infra:** Docker, Git, Cloudflare R2 (S3), Gmail SMTP
- **Testes:** Pest PHP (22 testes, 59 assertions)
- **Pacotes:** spatie/laravel-activitylog, wandesnet/qrcode-pix-laravel, DomPDF, Laravel Mail

---

## Freela de Frontend PHP

**Contexto:** Um site existente precisava ser atualizado para atender novas exigências do cliente — o layout e a experiência do usuário não estavam mais adequados.

**O que fiz:** Otimizei o frontend, ajustei a estrutura HTML/CSS, e integrei as novas funcionalidades solicitadas pelo cliente.

**Aprendizado:** Foi meu primeiro contato com código rodando em produção, com prazos reais e com um cliente usando o sistema de verdade. Aprendi na prática sobre entregar valor sem quebrar o que já funciona.

---

## API Fake com CRUDCRUD

**Contexto:** Projeto de estudo para entender o ecossistema de APIs REST — como os dados trafegam, como o frontend se comunica com o backend, e como tratar erros de rede e servidor.

**O que fiz:** Criei uma API simulada que consome o serviço CRUDCRUD (API externa fake), usando JavaScript `fetch()` para fazer requisições GET, POST, PUT e DELETE, manipulando JSON e exibindo os resultados no DOM.

**Aprendizado:** Foi onde entendi na prática os fundamentos de:
- Requisições HTTP e seus métodos
- headers, body, status codes
- JSON como formato de transporte
- Tratamento de erros (timeout, 404, 500)
- Assincronismo com Promises e async/await

---

## Formação

### Curso Técnico em Azure — SENAI
Foi meu primeiro contato formal com tecnologia. O curso abordou conceitos de cloud computing, serviços Microsoft Azure, e fundamentos de TI. Foi ali que comecei a me interessar por desenvolvimento.

### [Trilha de estudos mentorada (marcelao.dev)](https://marcelao.dev)
Uma trilha completa e prática montada pelo meu mentor, um desenvolvedor sênior experiente. O percurso está documentado em [marcelao.dev](https://marcelao.dev) e contém todos os passos que segui para evoluir como desenvolvedor — desde lógica de programação até arquitetura de sistemas com Laravel.

### Autodidata
A maior parte do meu conhecimento veio da prática: documentação oficial (Laravel, PHP, PostgreSQL), fóruns (Stack Overflow, Laravel Brasil), tutoriais, e principalmente construir projetos reais e quebrar a cabeça até funcionar.

---

## Habilidades consolidadas

| Área | Tecnologias |
|---|---|---|
| Backend | Laravel, PHP 8.x, Eloquent, REST APIs, **Java (Spring Boot — iniciando)** |
| Frontend | HTML, CSS, JavaScript, TypeScript, Blade, **React (iniciando)** |
| Banco | PostgreSQL, MySQL, migrations, SQL |
| Infra | Docker, Git/GitHub, Linux, Cloudflare R2 |
| Cloud | Azure (fundamentos), AWS S3 (iniciando) |
| Testes | Pest PHP |
| Ferramentas | Activity Log, DomPDF, GitHub Actions (básico) |
