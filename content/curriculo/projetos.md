# Projetos em Destaque

## Pescador IA
[https://github.com/m4th3usfp/pescador](https://github.com/m4th3usfp/pescador/tree/pescador_IA)

Sistema completo de gestão para colônias de pescadores. Laravel 11, PostgreSQL 17, Docker.

**Destaques técnicos:**
- Refatorei controller monolítico de ~1638 linhas em 5 controllers especializados
- Implementei sistema de autorização com roles (admin, supervisor, user) e Gates
- Corrigi race conditions de `record_number` usando `pg_advisory_xact_lock`
- Resolvi dívida técnica: migrations com typos, `env()` no código, autorização por nome de usuário
- Geração automatizada de documentos Word (PIS, recibos, auto declaração)
- Geração de QR Code PIX para cobrança com envio por email
- Backup automatizado com envio para Cloudflare R2
- Auditoria de ações com spatie/laravel-activitylog
- 22 testes automatizados com Pest PHP (59 assertions)

## Projetos de Estudo
- **Trilha de Estudos — marcelao.dev:** Percurso completo de aprendizado para desenvolvimento web, abrangendo lógica, PHP, Laravel, banco de dados, Docker, Git e boas práticas.
- **API Fake com CRUDCRUD:** Projeto para aprendizado de consumo de APIs REST com JavaScript puro, fetch(), JSON e protocolos HTTP.
