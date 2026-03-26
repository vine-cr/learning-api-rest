# Learning API REST

Uma API REST simples e educativa desenvolvida em PHP puro, sem uso de frameworks externos, utilizando um arquivo JSON para armazenamento de dados local.

## Funcionalidades
- **Criar utilizador** (`POST /api/users`)
- **Listar utilizadores** (`GET /api/users`)
- **Atualizar utilizador completamente** (`PUT /api/users?id={id}`)
- **Atualizar utilizador parcialmente** (`PATCH /api/users?id={id}`)
- **Remover utilizador** (`DELETE /api/users?id={id}`)

## Estrutura do Projeto
- `/src`: Contém o código fonte principal da API (configurações, roteamento e controladores).
- `/data`: Contém o arquivo `data.json` que simula a nossa base de dados.
- `/views`: Contém a interface do Swagger UI (`docs.html`).

## Como Executar
1. Certifica-te de ter o PHP instalado na tua máquina.
2. Abre o terminal na raiz do projeto e inicia o servidor embutido do PHP apontando para a pasta pública:
   ```bash
   php -S localhost:8000 -t src/public