# O que eu resolvo

Sou desenvolvedor fullstack com 3 anos de estudo e prática contínua. Meu trabalho é pegar um problema real — seja uma ideia nova ou um sistema legado — e entregar uma solução em software que funciona de verdade.

---

## 1. Criação de sistemas do zero

Quando alguém tem um processo manual (planilhas, papel, e-mails soltos) e quer transformar em um sistema web, eu cuido de todas as etapas:

### Levantamento
Entendo o fluxo de trabalho, as regras de negócio, quem usa o sistema e o que precisam entregar.

### Modelagem de dados
Projeto o banco relacional pensando em integridade, performance e crescimento futuro. PostgresSQL ou MySQL, dependendo do caso.

### Backend
Desenvolvo a lógica de negócio em Laravel com PHP, organizando em controllers, services, actions e commands. Implemento autenticação, autorização com Gates/roles, relatórios, e integrações.

### Frontend
Construo a interface com HTML, CSS e JavaScript/TypeScript — de forma que o usuário final consiga usar sem treinamento.

### Deploy
Empacoto com Docker, versiono com Git/GitHub, e preparo o ambiente de produção.

**Exemplo real:** O sistema [**Pescador**](https://github.com/m4th3usfp/pescador) — uma aplicação completa para gestão de colônias de pescadores, com cadastro de pescadores, geração de documentos (PIS, auto declaração, recibos), controle de pagamentos, upload de arquivos, backup automatizado, e geração de QR Code PIX para cobrança. Note como o sistema unifica o que antes era espalhado em papéis e planilhas.

---

## 2. Manutenção e evolução de sistemas existentes

Nem todo trabalho começar com uma tela em branco. Também atuo em projetos que já existem:

### Correção de bugs
Analiso o erro, encontro a causa raiz e aplico a correção sem efeitos colaterais.

### Refatoração
Pego código legado — controllers de 1600 linhas, lógica duplicada, validações espalhadas — e reorganizo em camadas, extraio classes, unifico padrões.

### Dívida técnica
Typo em migrations, valores hardcoded, autorização baseada em nome de usuário. Identifico e corrijo esses problemas estruturais.

### Performance
Consultas N+1, falta de índices, locking desnecessário. Otimizo o banco e o código.

**Exemplo real:** No **Pescador IA**, refatorei um controller de ~1638 linhas em 5 controllers especializados, corrigi 6 migrations com typos, removi autorização insegura baseada em nomes, troquei `FOR UPDATE` por `advisory lock` para compatibilidade com PostgreSQL, e corrigi 22 testes quebrados.

---

## 3. Automação de processos

Mapeio processos manuais e os transformo em fluxos automatizados dentro do sistema:

- Geração de documentos Word/PDF com dados do banco
- Envio de emails automáticos com relatórios e cobranças
- Backup agendado com envio para nuvem (S3/R2)
- Geração de QR Code PIX para pagamentos

---

## Tecnologias que uso

### Domínio consolidado
- **Laravel** — controllers, commands, jobs, events, policies, gates, middlewares, actions
- **PHP 8.x** — OOP, traits, enums, type hints
- **PostgreSQL / MySQL** — migrations, relacionamentos, índices, transactions, advisory locks
- **JavaScript / TypeScript** — manipulação DOM, fetch, formulários dinâmicos
- **HTML + CSS** — layouts responsivos, componentes reutilizáveis
- **Git / GitHub** — versionamento, branches, commits semânticos
- **Docker** — containers para desenvolvimento e produção

### Em evolução
- **AWS** — S3, R2 (Cloudflare), conceitos de cloud
- **Activity Log (spatie/laravel-activitylog)** — auditoria de ações do usuário
- **Pest PHP** — testes automatizados
- **DomPDF** — geração de documentos PDF
