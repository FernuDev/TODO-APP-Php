# ✅ TODO App

¡Bienvenido a la TODO App! 🚀 Esta aplicación te ayuda a gestionar tus tareas con estilo y eficiencia, aprovechando un backend en PHP y un frontend potente desarrollado con **React** y **Vite**. Perfecta para organizar tu día y aumentar tu productividad. 💪

## 🎉 Características
- ✔️ CRUD completo (Crear, Leer, Actualizar, Eliminar)
- ✔️ API RESTful con PHP y MySQL
- ✔️ Frontend moderno y dinámico con React y Vite
- ✔️ Gestión de tareas pendientes y completadas
- ✔️ Diseño interactivo y responsivo

## 🛠️ Requisitos
- PHP 8.0 o superior
- MySQL 8.0 o superior
- Node.js 18 o superior
- npm o yarn
- Composer (opcional)
- Servidor Web (Apache o el servidor embebido de PHP)

## 📂 Estructura del Proyecto
```bash
TODO-Backend
├── index.php
|   ├── src
|   │   ├── config
|   │   │   └── Database.php
|   │   ├── controllers
|   │   │   └── TodoController.php
|   │   └── models
|   │       └── Todo.php

TODO-Frontend
│   ├── src
│   │   ├── App.jsx
│   │   ├── components
│   │   │   ├── TodoList.jsx
│   │   │   ├── TodoItem.jsx
│   │   └── services
│   │       └── api.js
│   └── public
```

## ⚙️ Configuración
1. Clona el repositorio e ingresa al directorio del proyecto:
```bash
git clone https://github.com/tuusuario/todo-app.git
cd todo-app
```

2. Configuración del Backend:
```php
$host = "localhost";
$db_name = "todo_db";
$username = "root";
$password = "tu_contraseña";
```
3. Crea la base de datos y la tabla:
```sql
CREATE DATABASE todoapp;
USE todoapp;
CREATE TABLE todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    completed BOOLEAN NOT NULL DEFAULT 0
);
```

4. Configuración del Frontend:
```bash
cd frontend
npm install
npm run dev
```

## ▶️ Ejecución
1. Inicia el Backend:
```bash
cd TODO-Backend
php -S localhost:8000 index.php
```

2. Ejecuta el Frontend en otro terminal:
```bash
cd TODO-Frontend
npm run dev
```

3. Prueba la App en tu navegador:
[http://localhost:5173](http://localhost:5173)

## 📝 Licencia
Este proyecto está bajo la licencia MIT.

