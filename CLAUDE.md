# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Idioma

O desenvolvedor se comunica em **português brasileiro**. Responda sempre em pt-BR.

## Visão Geral do Projeto

**TimeTracker** — aplicação web em **Laravel 12** para registro e monitoramento de tempo gasto em atividades profissionais. Permite registrar tarefas, acompanhar tempo por projeto e gerar relatórios mensais de produtividade.

## Stack Tecnológica

- **Framework:** Laravel 12 (PHP)
- **IDE:** JetBrains PhpStorm / IntelliJ IDEA
- **Análise Estática:** PHP MessDetector, PHP CodeSniffer Fixer, PHPStan, Psalm

## Modelo de Usuário

- Autenticação individual, acesso privado (cada usuário vê apenas seus dados)
- Sistema single-tenant, sem hierarquia (sem admin/colaborador)
- Todas as queries devem ser scopadas pelo usuário autenticado

## Funcionalidades Principais

### Projetos
- CRUD com nome, descrição e cor
- Soft delete (desativar/reativar)
- Total de horas acumuladas por projeto

### Atividades
- CRUD manual com: título, descrição, início, término, projeto (opcional), links externos (GitHub, Todoist, etc)
- **Timer automático:** botão "Iniciar agora" / "Parar" com indicador visual
- Apenas uma atividade em andamento por vez
- Soft delete

### Cálculo Automático de Duração
- `duration_minutes = ended_at - started_at`
- Calculado automaticamente ao salvar
- Exibição formatada em HH:MM
- Validação: `ended_at > started_at`

## Comandos Docker (desenvolvimento)

```bash
# Subir/parar containers
docker compose up -d
docker compose down

# Executar comandos artisan
docker compose exec app php artisan <comando>

# Executar composer
docker compose exec app composer <comando>

# Executar npm
docker compose exec app npm <comando>

# Migrations
docker compose exec app php artisan migrate

# Testes
docker compose exec app php artisan test

# Tinker
docker compose exec app php artisan tinker
```

- **App:** http://localhost:8080
- **MySQL:** localhost:3306 (user: timetracking / senha: secret / db: timetracking)

## Arquitetura Técnica

### Stack
- **Backend:** Laravel 12 (PHP 8.3+), MySQL 8.0+, Eloquent ORM
- **Frontend:** Blade Templates, Livewire 3 (timer tempo real), Alpine.js, Tailwind CSS, Chart.js (gráficos)
- **Autenticação:** Laravel Breeze
- **Extras:** Yajra DataTables, Laravel Excel ou DomPDF (exportação), Carbon

### Padrões de Projeto
- **MVC:** Resource Controllers + Eloquent Models + Blade Views
- **Service Layer:** `ActivityService` (lógica de negócio), `ReportService` (relatórios)
- **Observers:** `ActivityObserver` — calcula `duration_minutes` automaticamente
- **Form Requests:** validação centralizada e reutilizável

## Estrutura de Dados

### Relacionamentos
- 1 User → N Projects
- 1 User → N Activities
- 1 Project → N Activities

### users
| Campo | Tipo |
|-------|------|
| id | PK |
| name | string |
| email | string (único) |
| password | string (hash) |
| created_at, updated_at | timestamps |

### projects
| Campo | Tipo |
|-------|------|
| id | PK |
| user_id | FK → users |
| name | string |
| description | text (opcional) |
| color | string hex (ex: "#3B82F6") |
| is_active | boolean |
| created_at, updated_at, deleted_at | timestamps + soft delete |

### activities
| Campo | Tipo |
|-------|------|
| id | PK |
| user_id | FK → users |
| project_id | FK → projects (opcional) |
| title | string |
| description | text (opcional) |
| started_at | datetime |
| ended_at | datetime (nullable — null = em andamento) |
| duration_minutes | integer (calculado) |
| github_link | URL (opcional) |
| todoist_link | URL (opcional) |
| other_links | JSON (flexível) |
| created_at, updated_at, deleted_at | timestamps + soft delete |
