<p align="center">
  <h1 align="center">Sales Management System for a Motorcycle Dealership</h1>
  <p align="center">
    Full admin panel for inventory, sales, credit and collections management.
  </p>
</p>

<p align="center">
  <a href="https://laravel.com" target="_blank"><img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel"></a>
  <a href="https://www.php.net/" target="_blank"><img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP"></a>
  <a href="https://www.mysql.com/" target="_blank"><img src="https://img.shields.io/badge/MySQL-8-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL"></a>
  <a href="https://adminlte.io/" target="_blank"><img src="https://img.shields.io/badge/UI-AdminLTE-1F2937?style=flat-square" alt="AdminLTE"></a>
  <a href="https://getbootstrap.com/" target="_blank"><img src="https://img.shields.io/badge/Bootstrap-5-7952B3?style=flat-square&logo=bootstrap&logoColor=white" alt="Bootstrap"></a>
  <a href="https://vitejs.dev/" target="_blank"><img src="https://img.shields.io/badge/Vite-6-646CFF?style=flat-square&logo=vite&logoColor=white" alt="Vite"></a>
  <a href="https://tailwindcss.com/" target="_blank"><img src="https://img.shields.io/badge/Tailwind_CSS-3-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white" alt="Tailwind CSS"></a>
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="License">
</p>

<p align="center">
  <a href="README.md">Español</a> · <strong>English</strong>
</p>

---

Web application built to run a motorcycle dealership end to end: from purchasing from suppliers and inventory control, to cash or credit sales, installment tracking, and receipt issuance.

The application is built on **Laravel 11** following the **MVC** pattern, with an **AdminLTE 3** based admin interface and a role/permission authorization model that controls access to every operation in the system.

## Tech stack

### Backend

| Technology | Purpose |
|---|---|
| PHP 8.2 | Programming language |
| Laravel 11 | MVC framework: routing, Eloquent ORM, validation, migrations, transactions |
| MySQL | Relational database |
| Laravel UI | Authentication (login, registration, password recovery by email) |
| Spatie Laravel Permission | Roles and permissions management (RBAC) |
| Database sessions, cache and queues | State persistence without external dependencies |

### Frontend

| Technology | Purpose |
|---|---|
| AdminLTE 3 | Admin panel template (sidebar, navbar, widgets) |
| Bootstrap 5 | Grid system and UI components |
| jQuery + DataTables | Tabular UI with search, sorting and pagination |
| Chart.js | Line and bar charts on the dashboard and reports |
| Blade | Template engine (~100 views) |
| Vite 6 + Tailwind CSS 3 + Sass | Asset compilation and style utilities |

### Reporting and tooling

| Technology | Purpose |
|---|---|
| barryvdh/laravel-dompdf | PDF receipts and reports generation |
| luecano/numero-a-letras | Converts numeric amounts to words on receipts |
| Laravel Pint | Code formatting |
| Laravel Pail | Real-time log viewer |
| Laravel Sail | Docker-based development environment |

## Features

- **Admin dashboard** — counts for roles, users, motorcycles, purchases, customers, sales and credits, with monthly trend charts and automatic detection of overdue clients.

- **Motorcycle inventory** — create, edit and delete motorcycles with brand, condition (`in_stock` / sold), prices and image upload.

- **Supplier purchases** — purchase registration with a temporary motorcycle cart (persisted in database and session), editing motorcycles within a purchase, and inline supplier creation.

- **Cash and credit sales** — automatic installment calculation with interest rate, business rules applied (for example, spouse data required depending on marital status), and atomic registration of the sale with its detail.

- **Credit and collections control** — installment payment with late fee calculation, installment statuses (`Pending` / `Paid`), credit summary and payment history.

- **Customers** — full profile with personal data, address, profession, nationality and spouse information.

- **Users, roles and permissions** — user administration with role assignment, granular permission management and module-level access control (`view`, `create`, `edit`, `delete`, `assign`).

- **Reports and printing** — sales receipts, credit summaries and collection reports as PDF, with amounts written out in words.

## Architecture and technical decisions

**MVC pattern with Eloquent ORM.** Every module (motorcycles, purchases, sales, credits, customers, users) follows the `Route → Controller → Model → View` structure, with versioned migrations documenting the database schema and seeders for initial data (brands, nationalities, permissions).

**Role-based access control (RBAC).** Instead of a plain `auth` middleware, each route declares the exact permission it requires via `->middleware('can:sales-view')`. Permissions are managed through the UI and assigned to roles, allowing access profiles (manager, seller, admin) to be defined without touching code.

**Integrity through transactions.** Critical operations — sale registration, credit creation and installment collection — run inside `DB::transaction()`, ensuring that changes to the sale, credit, installment details and stock are applied atomically.

**Temporary purchase cart.** Purchase building is handled through an intermediate `tmp_motos` table tied to the user session, combined with AJAX calls (jQuery) that add, edit and remove motorcycles without reloading the page. Temporary records are cleared when the purchase is confirmed or cancelled.

**Server-side PDF generation.** Receipts are rendered with Blade as standalone HTML views and converted to PDF with Dompdf, avoiding external service dependencies and allowing full control over the layout.

**AdminLTE-based presentation layer.** The panel layout is customized over the AdminLTE 3 template, with a side menu configurable from `config/adminlte.php` that reflects the system modules.

**Spanish localization.** Validation, authentication and pagination messages translated to Spanish through Laravel language files.

---

<p align="center">
  <sub>Built with Laravel · <a href="https://laravel.com/docs">Documentation</a></sub>
</p>
