# CRUD PHP Project - Backend

Backend de um sistema CRUD de usuarios, desenvolvido em **PHP 8.2** com armazenamento em **arquivo JSON**. Este repositorio contem apenas o backend â€” o frontend consome a API via HTTP.

## Sumario

- [Visao Geral](#visao-geral)
- [Como Rodar o Backend](#como-rodar-o-backend)
- [Rotas da API](#rotas-da-api)
  - [Base URL](#base-url)
  - [Modelo de Dados](#modelo-de-dados)
  - [Endpoints](#endpoints)
  - [Formato de Erro](#formato-de-erro)
  - [CORS](#cors)
- [Exemplos de Requisicao e Resposta](#exemplos-de-requisicao-e-resposta)
- [Estrutura do Backend (referencia)](#estrutura-do-backend-referencia)

---

## Visao Geral

A API expõe o recurso **User** e permite listar, criar, editar e excluir usuarios. Os dados sao persistidos em `data/data.json`.

**Tecnologias do backend:**
- PHP 8.2
- JSON como armazenamento

---

## Como Rodar o Backend

### Com PHP embutido

```bash
cd backend
php -S localhost:8000 -t src/public
```

A API estara disponivel em `http://localhost:8000`.

> **Importante:** O frontend espera que a API esteja rodando em `http://localhost:8000`.

---

## Rotas da API

### Base URL

```
http://localhost:8000/api/users
```

### Modelo de Dados

A entidade gerenciada e **User** com os seguintes campos:

| Campo   | Tipo     | Descricao              | Obrigatorio |
|---------|----------|------------------------|-------------|
| `id`    | `number` | Identificador unico    | Gerado pela API |
| `name`  | `string` | Nome do usuario        | Sim |
| `age`   | `number` | Idade (numero inteiro) | Sim |
| `email` | `string` | E-mail do usuario      | Sim |

### Endpoints

#### 1. Listar usuarios

```
GET /api/users
```

**Resposta (200):**

```json
{
  "users": [
    { "id": 1, "name": "Ana", "age": 25, "email": "ana@email.com" },
    { "id": 2, "name": "Carlos", "age": 30, "email": "carlos@email.com" }
  ]
}
```

> A resposta **deve** ser um objeto com a chave `users` contendo um array. Se nao houver usuarios, retorne `{ "users": [] }`.

#### 2. Criar usuario

```
POST /api/users
Content-Type: application/json
```

**Corpo da requisicao:**

```json
{
  "name": "Ana",
  "age": 25,
  "email": "ana@email.com"
}
```

**Resposta de sucesso (201):** retorne o usuario criado (com `id` gerado).

```json
{
  "id": 1,
  "name": "Ana",
  "age": 25,
  "email": "ana@email.com"
}
```

**Resposta de erro (400/422):**

```json
{
  "error": "Descricao do erro"
}
```

#### 3. Atualizar usuario (substituicao total)

```
PUT /api/users?id={id}
Content-Type: application/json
```

**Corpo da requisicao (todos os campos):**

```json
{
  "name": "Ana Silva",
  "age": 26,
  "email": "ana.silva@email.com"
}
```

**Resposta de sucesso (200):** retorne o usuario atualizado.

**Resposta de erro (404):**

```json
{
  "error": "User not found"
}
```

#### 4. Atualizar usuario (parcial)

```
PATCH /api/users?id={id}
Content-Type: application/json
```

**Corpo da requisicao (apenas os campos alterados):**

```json
{
  "age": 27
}
```

O corpo pode conter **1 ou 2** campos (nunca os 3 â€” nesse caso o frontend usa PUT). Os campos nao enviados devem permanecer inalterados.

**Resposta de sucesso (200):** retorne o usuario atualizado.

**Resposta de erro (404):**

```json
{
  "error": "User not found"
}
```

#### 5. Deletar usuario

```
DELETE /api/users?id={id}
```

**Sem corpo na requisicao.**

**Resposta de sucesso (200):**

```json
{
  "message": "User deleted"
}
```

**Resposta de erro (404):**

```json
{
  "error": "User not found"
}
```

### Formato de Erro

Em caso de erro, a API retorna um JSON com a chave `error`:

```json
{
  "error": "Mensagem descrevendo o erro"
}
```

### CORS

Como o frontend roda em `localhost:8080` e a API em `localhost:8000`, a API deve configurar os headers CORS:

```
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS
Access-Control-Allow-Headers: Content-Type
```

---

## Exemplos de Requisicao e Resposta

### Criar

```bash
curl -X POST http://localhost:8000/api/users \
  -H "Content-Type: application/json" \
  -d '{"name": "Maria", "age": 22, "email": "maria@email.com"}'
```

### Listar

```bash
curl http://localhost:8000/api/users
```

### Atualizar (PUT)

```bash
curl -X PUT "http://localhost:8000/api/users?id=1" \
  -H "Content-Type: application/json" \
  -d '{"name": "Maria Santos", "age": 23, "email": "maria.santos@email.com"}'
```

### Atualizar (PATCH)

```bash
curl -X PATCH "http://localhost:8000/api/users?id=1" \
  -H "Content-Type: application/json" \
  -d '{"age": 24}'
```

### Deletar

```bash
curl -X DELETE "http://localhost:8000/api/users?id=1"
```

---

## Estrutura do Backend (referencia)

```
backend/
|- data/
|  |- data.json              # Base de dados (JSON)
|- src/
|  |- public/
|  |  |- index.php          # Entry point da API
|  |- config/
|  |  |- config.php         # Configuracoes gerais
|  |- api.php                # Router simples
|  |- controllers.php        # Controladores
|  |- services.php           # Regras de negocio
|  |- data.php               # Persistencia em JSON
|  |- validation.php         # Validacoes
|- composer.json
|- vendor/
```
