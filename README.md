# TimeTracker

Aplicacao web para registro e monitoramento de tempo gasto em atividades profissionais. Permite registrar tarefas, acompanhar tempo por projeto e gerar relatorios mensais de produtividade.

## Stack Tecnologica

- **Backend:** Laravel 12 (PHP 8.4), MySQL 8.0, Eloquent ORM
- **Frontend:** Blade Templates, Livewire 3, Alpine.js, Tailwind CSS, Chart.js
- **Autenticacao:** Laravel Breeze
- **Build:** Vite 7, Node.js 22
- **Infra:** Docker (PHP-FPM, Nginx, MySQL, Vite)

## Tema
- https://wrapmarket.com/item/duralux-php-admin-dashboard-bootstrap-template-WB053795D
- Preview: https://wrapmarket.com/item/WB053795D/preview

## Funcionalidades

### Projetos
- CRUD com nome, descricao e cor
- Soft delete (desativar/reativar)
- Total de horas acumuladas por projeto

### Atividades
- CRUD manual com titulo, descricao, inicio, termino, projeto (opcional) e links externos (GitHub, Todoist, etc)
- Timer automatico com botao "Iniciar agora" / "Parar" e indicador visual
- Apenas uma atividade em andamento por vez
- Soft delete

### Calculo Automatico de Duracao
- `duration_minutes = ended_at - started_at`
- Calculado automaticamente ao salvar
- Exibicao formatada em HH:MM

## Modelo de Usuario

- Autenticacao individual, acesso privado (cada usuario ve apenas seus dados)
- Sistema single-tenant, sem hierarquia (sem admin/colaborador)

## Estrutura de Dados

```
User 1──N Project
User 1──N Activity
Project 1──N Activity
```

### projects
| Campo | Tipo |
|-------|------|
| id | PK |
| user_id | FK -> users |
| name | string |
| description | text (opcional) |
| color | string hex (ex: "#3B82F6") |
| is_active | boolean |
| deleted_at | soft delete |

### activities
| Campo | Tipo |
|-------|------|
| id | PK |
| user_id | FK -> users |
| project_id | FK -> projects (opcional) |
| title | string |
| description | text (opcional) |
| started_at | datetime |
| ended_at | datetime (nullable = em andamento) |
| duration_minutes | integer (calculado) |
| github_link | URL (opcional) |
| todoist_link | URL (opcional) |
| other_links | JSON |
| deleted_at | soft delete |

## Como Rodar

### Pre-requisitos
- Docker e Docker Compose

### Subir o projeto

```bash
docker compose up -d
```

Isso inicia automaticamente:

| Container | Descricao | Porta |
|-----------|-----------|-------|
| timetracking-mysql | Banco de dados MySQL 8.0 | 3306 |
| timetracking-app | PHP-FPM com OPcache e caches Laravel | 9000 (interno) |
| timetracking-vite | Vite dev server com HMR | 5173 |
| timetracking-nginx | Proxy reverso | 8080 |

Acesse: **http://localhost:8080**

### Comandos uteis

```bash
# Migrations
docker compose exec app php artisan migrate

# Testes
docker compose exec app php artisan test

# Composer
docker compose exec app composer <comando>

# Artisan
docker compose exec app php artisan <comando>

# Tinker
docker compose exec app php artisan tinker
```

### Acessos

| Servico | URL / Host |
|---------|------------|
| App | http://localhost:8080 |
| Vite HMR | http://localhost:5173 |
| MySQL | localhost:3306 (user: `timetracking` / senha: `secret` / db: `timetracking`) |

## Arquitetura

### Padroes de Projeto
- **MVC:** Resource Controllers + Eloquent Models + Blade Views
- **Service Layer:** `ActivityService` (logica de negocio), `ReportService` (relatorios)
- **Observers:** `ActivityObserver` — calcula `duration_minutes` automaticamente
- **Form Requests:** validacao centralizada e reutilizavel
