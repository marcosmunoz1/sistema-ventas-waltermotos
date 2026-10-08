<p align="center">
  <h1 align="center">Sistema de Ventas para Concesionaria de Motos</h1>
  <p align="center">
    Panel administrativo completo para gestión de inventario, ventas, créditos y cobranzas.
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
  <img src="https://img.shields.io/badge/Licencia-MIT-green?style=flat-square" alt="License">
</p>

---

Sistema web desarrollado para administrar un concesionario de motos de punta a punta: desde la compra a proveedores y el control de inventario, hasta la venta al contado o a crédito, el seguimiento de cuotas y la emisión de comprobantes.

La aplicación está construida sobre **Laravel 11** siguiendo el patrón **MVC**, con una interfaz de administración basada en **AdminLTE 3** y un modelo de autorización por roles y permisos que controla el acceso a cada operación del sistema.

## Stack tecnológico

### Backend

| Tecnología | Uso |
|---|---|
| PHP 8.2 | Lenguaje de programación |
| Laravel 11 | Framework MVC: routing, Eloquent ORM, validaciones, migraciones, transacciones |
| MySQL | Base de datos relacional |
| Laravel UI | Autenticación (login, registro, recuperación de contraseña por email) |
| Spatie Laravel Permission | Gestión de roles y permisos (RBAC) |
| Sesiones, caché y colas en DB | Persistencia de estado sin dependencias externas |

### Frontend

| Tecnología | Uso |
|---|---|
| AdminLTE 3 | Plantilla del panel administrativo (sidebar, navbar, widgets) |
| Bootstrap 5 | Sistema de rejilla y componentes de interfaz |
| jQuery + DataTables | Interfaz tabular con búsqueda, ordenamiento y paginación |
| Chart.js | Gráficos de líneas y barras en el dashboard y reportes |
| Blade | Motor de plantillas (~100 vistas) |
| Vite 6 + Tailwind CSS 3 + Sass | Compilación de assets y utilidades de estilo |

### Reportes y utilidades

| Tecnología | Uso |
|---|---|
| barryvdh/laravel-dompdf | Generación de comprobantes y reportes en PDF |
| luecano/numero-a-letras | Conversión de montos numéricos a letras en los comprobantes |
| Laravel Pint | Formateo de código |
| Laravel Pail | Visualización de logs en tiempo real |
| Laravel Sail | Entorno de desarrollo con Docker |

## Funcionalidades

- **Dashboard administrativo** — indicadores de roles, usuarios, motos, compras, clientes, ventas y créditos, con gráficos de evolución mensual y detección automática de clientes morosos.

- **Inventario de motos** — alta, edición y baja de motos con marca, condición (`en_stock` / vendida), precios y carga de imágenes.

- **Compras a proveedores** — registro de compras con carrito temporal de motos (persistido en base de datos y sesión), edición de motos dentro de una compra y alta de proveedores en línea.

- **Ventas contado y a crédito** — cálculo automático del valor de cuota con tasa de interés, aplicación de reglas de negocio (por ejemplo, conyugue obligatorio según estado civil), y registro atómico de la venta con su detalle.

- **Control de créditos y cobranzas** — cobro de cuotas con cálculo de interés por mora, estados de cuota (`Pendiente` / `Paga`), resumen de crédito e historial de pagos.

- **Clientes** — ficha completa con datos personales, dirección, profesión, nacionalidad y conyugue.

- **Usuarios, roles y permisos** — administración de usuarios con asignación de roles, gestión de permisos granulares y control de acceso por módulo (`ver`, `crear`, `editar`, `eliminar`, `asignar`).

- **Reportes e impresión** — comprobantes de venta, resúmenes de crédito y reportes de cobranza en PDF, con montos expresados en letras.

## Arquitectura y decisiones técnicas

**Patrón MVC con Eloquent ORM.** Cada módulo (motos, compras, ventas, créditos, clientes, usuarios) sigue la estructura `Ruta → Controlador → Modelo → Vista`, con migraciones versionadas que documentan el esquema de la base de datos y seeders para datos iniciales (marcas, nacionalidades, permisos).

**Autorización por roles y permisos (RBAC).** En lugar de un simple middleware `auth`, cada ruta declara el permiso específico que exige mediante `->middleware('can:ventas-ver')`. Los permisos se administran desde la interfaz y se asignan a roles, lo que permite definir perfiles de acceso (gerente, vendedor, administrador) sin modificar código.

**Integridad mediante transacciones.** Las operaciones críticas —registro de ventas, generación de créditos y cobro de cuotas— se ejecutan dentro de `DB::transaction()`, garantizando que los cambios sobre venta, crédito, detalle de cuotas y stock se apliquen de forma atómica.

**Carrito temporal de compras.** El armado de una compra se resuelve con una tabla intermedia `tmp_motos` asociada a la sesión del usuario, combinada con llamadas AJAX (jQuery) que agregan, editan y eliminan motos sin recargar la página. Al confirmar o cancelar, los registros temporales se limpian.

**Generación de PDF en el servidor.** Los comprobantes se renderizan con Blade como vistas HTML independientes y se convierten a PDF con Dompdf, evitando dependencias de servicios externos y permitiendo control total del formato.

**Capa de presentación con AdminLTE.** El layout del panel se personalizó sobre la plantilla AdminLTE 3, con un menú lateral configurable desde `config/adminlte.php` que refleja los módulos del sistema.

**Localización en español.** Validaciones, mensajes de autenticación y paginación traducidos a español mediante los archivos de idioma de Laravel.

---

<p align="center">
  <sub>Desarrollado con Laravel · <a href="https://laravel.com/docs">Documentación</a></sub>
</p>
