# Projeto CRUD - Frontend + Backend

Este repositório contém um **sistema completo (Frontend e Backend) para o gerenciamento de usuários**. O projeto foi desenvolvido como parte de um desafio prático de requisições HTTP do **Instituto 3C+ Code Academy**.

A interface foi construída com **JavaScript Vanilla** e o backend foi inteiramente desenvolvido em **PHP puro**, utilizando persistência de dados em um arquivo JSON.

Nota: **O frontend deste projeto foi idealizado originalmente por victor-raphael17 em um repositório privado e integrado a esta API.**

## Sumario

- [Visao Geral](#visao-geral)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Como Rodar](#como-rodar)
  - [Backend](#backend)
  - [Frontend](#frontend)
- [API (Resumo)](#api-resumo)
- [Observacoes](#observacoes)

---

## Visao Geral

- **Backend:** API em PHP 8.2, persistencia em arquivo JSON.
- **Frontend:** CRUD com JavaScript vanilla e Bootstrap.

---

## Estrutura do Projeto

```
backend/
|- data/
|  |- data.json
|- src/
|  |- public/
|  |  |- index.php
|  |- config/
|  |  |- config.php
|  |- api.php
|  |- controllers.php
|  |- services.php
|  |- data.php
|  |- validation.php
|- composer.json
|- vendor/

frontend/
|- crud-frontend/
|  |- src/
|  |- Dockerfile
|  |- compose.yaml
|  |- README.md
```

---

## Como Rodar

### Backend

```bash
cd backend
php -S localhost:8000 -t src/public
```

API disponivel em `http://localhost:8000`.

### Frontend

Com Docker:

```bash
cd frontend/crud-frontend
docker compose up --build
```

Frontend disponivel em `http://localhost:8080`.

---

## API (Resumo)

Base URL:

```
http://localhost:8000/api/users
```

Endpoints principais:

- `GET /api/users`
- `POST /api/users`
- `PUT /api/users?id={id}`
- `PATCH /api/users?id={id}`
- `DELETE /api/users?id={id}`

Formato de erro:

```json
{ "error": "Mensagem" }
```

---

## Observacoes

- O frontend consome a API via Fetch usando JSON.
- O backend deve estar rodando antes do frontend para as requisicoes funcionarem.
- Este projeto e apenas para fins educacionais.