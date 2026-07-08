# Experiências

## Colonia dos Pescadores — Sistema de Gestão para Colônias de Pescadores
*2024 — Presente | Projeto próprio / sob demanda*

Sistema web completo em Laravel 11 + PostgreSQL 17 para gestão de colônias de pescadores.

**Principais realizações:**
- Refatorei controller monolítico de ~1638 linhas em 5 controllers especializados
- Implementei sistema de autorização com roles (admin, supervisor, user) e Gates do Laravel
- Corrigi race conditions de `record_number` usando `pg_advisory_xact_lock` (PostgreSQL)
- Resolvi dívida técnica: migrations com typos, `env()` no código, autorização por nome de usuário
- Geração automatizada de documentos Word (PIS, recibos, auto declaração)
- Geração de QR Code PIX para cobrança com envio por email
- Backup automatizado com envio para Cloudflare R2
- Auditoria de ações com spatie/laravel-activitylog
- 22 testes automatizados com Pest PHP (59 assertions)

**Tecnologias:** Laravel 11, PHP 8.x, PostgreSQL 17, Docker, Blade, JavaScript, Git, Cloudflare R2, Pest PHP

## Freela de Frontend PHP
*2023*

Otimização de frontend de site existente para atender novas exigências do cliente. Trabalho com código em produção, prazos reais e necessidades do cliente.

**Tecnologias:** PHP, HTML, CSS, JavaScript

## Outras Experiências
Atendimento ao cliente, vendas, suporte técnico e gestão de estoque (1 ano).
