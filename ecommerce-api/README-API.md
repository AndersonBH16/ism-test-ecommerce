# 🛠 Ecommerce: Backend

Este es el backend del sistema **Ecommerce**, construido con **Laravel 11** y configurado para ejecutarse con **Docker** usando `docker-compose`. Aquí se gestiona la lógica de negocio, autenticación (JWT), procesamiento de pedidos y operaciones con base de datos MySQL.

---

## 🧰 Tecnologías Utilizadas

| Tecnología                                                                | Descripción              |
|---------------------------------------------------------------------------|--------------------------|
| ![Laravel](https://img.shields.io/badge/Laravel-11-red?logo=laravel)      | Framework backend        |
| ![PHP](https://img.shields.io/badge/PHP-8.3-blue?logo=php)                | Lenguaje principal       |
| ![MySQL](https://img.shields.io/badge/MySQL-8.3-blue?logo=mysql)          | Base de datos relacional |
| ![Docker](https://img.shields.io/badge/Docker-Container-blue?logo=docker) | Contenedores             |
| ![JWT](https://img.shields.io/badge/JWT-Auth-orange?logo=jsonwebtokens)   | Autenticación segura     |

---

## ⚙️ Pasos para levantar el proyecto

Sigue estos pasos para poner en marcha el backend en tu entorno local utilizando Docker:

### 1. Acceder al directorio del backend

```bash
cd ecommerce-api
```

### 2. Configure environment variables.
Abrir y modificar el archivo `.env` de la raíz del proyecto.

    ```.env
    APP_ENV=local
    DB_HOST=ecommerce-db
    DB_DATABASE=ism-ecommerce
    DB_USERNAME=andersonbh
    DB_PASSWORD=qwerty
    ```

### 3. Configurar dockers
    - Crear y ejecutar contenedores: (Puede tomar un tiempo para configurar e instalar)
         ```sh
         docker-compose up -d --build
         ```
    - Mostrar containers
       ```sh
       docker ps
       ```
    - Acceder a los contenedores:
         ```sh
         docker exec -it app-interview bash
         ```      
    - Si necesitas eliminar los contenedores (opcional)
       ```sh
        docker-compose down
      ```

   Ahora, configuraremos la base de datos

### 4. Instalar dependencias de composer:
   ```sh
   composer install
   ```

### 5. Crear laravel key
   ```sh
   php artisan key:generate
   ```

### 6. Run database migrations:
   ```sh
   php artisan migrate
   ```

### 7. Llenar la base de datos
   ```sh
   php artisan db:seed
   ```

## Credenciales de Acceso

Utiliza los siguientes datos de prueba para autenticarte en el sistema:

- **Usuario:** `anderson@test.com`
- **Contraseña:** `password`

## Endpoint Base

La API está disponible en: http://localhost:8068

## Recomendación

Puedes utilizar **[Postman](https://www.postman.com/)** para realizar pruebas de los distintos endpoints.

### Ejemplo de Inicio de Sesión

1. Método: `POST`
2. URL: `http://localhost:8068/api/auth/login`
3. Body (JSON):

```json
{
  "email": "anderson@test.com",
  "password": "password"
}
```

Desarrollado por Anderson Blas

