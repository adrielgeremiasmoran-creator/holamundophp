# holamundophp

CRUD de usuarios en **PHP puro con patron MVC** (sin framework).

## Stack
- PHP 8.1 (XAMPP) con SQLite via PDO
- Bootstrap 5.3 + SweetAlert2 (CDN)
- Git/GitHub con flujo de ramas y Pull Requests

## Estructura MVC
- app/core: router (App.php), controlador base (Controller.php), conexion PDO (Database.php)
- app/controllers: UsersController (index, create, store, edit, update, destroy)
- app/models: User (PDO con prepared statements)
- app/views: layouts (header/footer) + users (index, create, edit)
- public: front controller (index.php) + .htaccess

## Instalacion
1. Descomprimir en C:\xampp\htdocs\
2. php.ini: activar extension=sqlite3 y extension=pdo_sqlite; reiniciar Apache
3. Abrir http://localhost/holamundophp/public/users
4. Para resembrar 5 usuarios de prueba: php database/seed.php

## Autor
Adriel Geremias Moran