# O que já fiz

## Pescador IA — Sistema de Gestão para Colônias de Pescadores
Meu maior e mais complexo projeto: [**Pescador**](https://github.com/m4th3usfp/pescador). Uma aplicação web completa construída com Laravel 11 e PostgreSQL 17 que unifica o gerenciamento de colônias de pescadores.

**Funcionalidades:** cadastro de pescadores, geração de documentos (PIS, auto declaração, recibos em Word), controle de pagamentos, upload de arquivos, backup automatizado com envio para Cloudflare R2, geração de QR Code PIX, e auditoria de ações com Activity Log.

**Destaques técnicos:** refatorei um controller de ~1638 linhas em 5 controllers, corrigi race conditions com advisory locks, implementei sistema de roles e Gates, e resolvi todo o débito técnico acumulado (migrations com typos, env() no código, autorização por nome de usuário).

## Freela de Frontend PHP
Trabalhei na otimização do frontend de um site existente para atender novas exigências do cliente. Foi meu primeiro contato com código em produção e com as dores reais de um projeto sendo usado por usuários.

## API Fake com CRUDCRUD
Projeto de estudo para entender como funciona o ecossistema de APIs: fiz uma API simulada que consome dados do serviço CRUDCRUD, usando fetch() do JavaScript, transações JSON, protocolos HTTP e tratamento de erros. Foi onde consolidei minha base em comunicação cliente-servidor.

## Formação
- **Curso Técnico em Azure** — SENAI (onde comecei meu interesse pela área)
- **Trilha de estudos mentorada** por desenvolvedor sênior — percurso completo disponível em [marcelao.dev](https://marcelao.dev) com todos os passos que segui
- **Autodidata** — aprendizado contínuo com documentação, fóruns, e prática em projetos reais
