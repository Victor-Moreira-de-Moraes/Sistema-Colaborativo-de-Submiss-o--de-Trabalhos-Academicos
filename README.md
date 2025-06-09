# Laravel Acadêmico

Projeto para gerenciamento de equipes, submissões e versões de trabalhos com revisão colaborativa.

## OBS: CASO NÃO CONSIGA INICIALIZAR O PROJETO, TEM UM PDF COM NOME DE "TELAS.PDF", MOSTRANDO TODAS AS TELAS DO PROJETO.

## Pré-requisitos

- PHP ≥ 8.0  
- Composer  
- MySQL (ou MariaDB)  
- Node.js ≥ 14 + npm (ou Yarn)  
- Servidor local (XAMPP, Valet, Laragon) ou Docker/Sail

## Instalação

1. Clone o repositório  
   ```bash
   git clone https://github.com/seuusuario/seuprojeto.git
   cd seuprojeto
   ```

2. Instale dependências PHP  
   ```bash
   composer install
   ```

3. Instale dependências front-end  
   ```bash
   npm install
   # ou yarn install
   ```

4. Configure o ambiente  
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Atualize as variáveis de conexão no `.env`.

5. Crie o link para storage  
   ```bash
   php artisan storage:link
   ```

6. Crie o banco de dados e rode migrations  
   ```bash
   php artisan migrate
   ```

## Executando

Use o servidor embutido do PHP:
```bash
php artisan serve
```
Acesse `http://127.0.0.1:8000`.

Para hot-reload de assets:
```bash
npm run dev
# ou yarn dev
```

## Funcionalidades

- Cadastro e gerenciamento de equipes  
- Convite de membros  
- CRUD de submissões por equipe  
- Versionamento de cada submissão  
- Comentários colaborativos em cada versão  
- Autenticação e políticas de acesso

## Rotas principais

- `/dashboard` – visão geral das equipes e status de submissões  
- `/teams` – CRUD de equipes  
- `/teams/{team}/submissions` – CRUD de trabalhos  
- `/teams/{team}/submissions/{submission}/versions` – versionamento  
- `/teams/{team}/submissions/{submission}/versions/{version}/comments` – comentários

---

Desenvolvido em Laravel. Sinta-se à vontade para personalizar conforme seu ambiente.
