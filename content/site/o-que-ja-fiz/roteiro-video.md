# Roteiro de Vídeo — O que já fiz

**Duração estimada:** 3 a 4 minutos  
**Tom:** Profissional, mostrando resultados, didático

---

## Cena 1 — Abertura (0:00–0:20)

**Vídeo:** Você na tela  
**Áudio:**

"Meu nome é Matheus Pizzinato, e hoje vou mostrar os projetos que construí nos últimos 3 anos.  
O principal deles é o [Pescador](https://github.com/m4th3usfp/pescador), um sistema completo de gestão para colônias de pescadores.  
Mas também tive outras experiências que contribuíram muito pro meu crescimento."

---

## Cena 2 — Pescador IA — visão geral (0:20–1:00)

**Vídeo:** Navegador mostrando o sistema rodando — tela de login, dashboard, listagem de pescadores  
**Áudio:**

"O [Pescador](https://github.com/m4th3usfp/pescador) é o meu projeto mais completo. Laravel 11 com PostgreSQL 17, tudo rodando em Docker.  
Ele gerencia colônias de pescadores: cadastro, documentos, pagamentos, arquivos.  
Antes tudo era no papel ou planilha — agora está centralizado numa plataforma web."

---

## Cena 3 — Pescador IA — bastidores técnicos (1:00–1:50)

**Vídeo:** Mostrando código no VS Code — controllers, migrations, diffs do Git  
**Áudio:**

"Mas o mais interessante está nos bastidores.  
Quando entrei no projeto, ele tinha um controller de 1638 linhas, autorização baseada em nome de usuário, e migrations com typo.  
Eu refatorei tudo: dividi em 5 controllers, implementei roles com Gates do Laravel, corrigi race conditions usando advisory locks do PostgreSQL, e resolvi mais de 10 problemas estruturais.  
No final, 22 testes passando e um código que dá pra manter e evoluir."

---

## Cena 4 — Freela PHP (1:50–2:20)

**Vídeo:** Mostrando site antigo vs novo (se tiver captura)  
**Áudio:**

"Antes do Pescador, tive um freela de PHP onde otimizei o frontend de um site que precisava se adaptar a novas exigências do cliente.  
Foi meu primeiro contato com código em produção — aprendi na prática que entregar software não é só escrever código, mas resolver o problema de quem usa."

---

## Cena 5 — API Fake com CRUDCRUD (2:20–2:50)

**Vídeo:** Mostrando código JavaScript com fetch(), console com requisições  
**Áudio:**

"Outro projeto importante foi uma API fake usando o serviço CRUDCRUD.  
Eu criei uma aplicação que consumia uma API externa com JavaScript puro — fetch, JSON, tratamento de erros.  
Foi onde eu entendi de verdade como cliente e servidor conversam."

---

## Cena 6 — Formação (2:50–3:20)

**Vídeo:** Site marcelao.dev, certificado Azure SENAI  
**Áudio:**

"Minha formação veio de três lugares:  
um curso técnico em Azure no SENAI, onde comecei a me interessar por tecnologia;  
uma [trilha de estudos mentorada disponível em marcelao.dev](https://marcelao.dev), que me guiou passo a passo;  
e muita prática autodidata — porque nada substitui sentar e codar."

---

## Cena 7 — Encerramento (3:20–3:40)

**Vídeo:** Você na tela  
**Áudio:**

"Esses projetos me deram uma base sólida em Laravel, PHP, PostgreSQL, Docker, e boas práticas de engenharia de software.  
Se você busca um desenvolvedor fullstack que entrega solução, não só código, vamos conversar."

---

## Notas de produção
- Mostrar o sistema Pescador rodando de verdade (logado, navegando)
- No antes/depois da refatoração, mostrar o diff real no GitHub
- Se possível, mostrar o marcelao.dev como referência
