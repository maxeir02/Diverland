
# Sistema de Gestión Diverland

Este proyecto es un sistema de gestión desarrollado en Laravel para la administración de clientes y eventos en Diverland.

---

## Requisitos Previos

Antes de instalar este sistema, asegúrate de tener instalado en tu equipo:

- [PHP 8.1 o superior](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [MySQL o MariaDB](https://www.mysql.com/) (u otro motor compatible)
- [Node.js y npm](https://nodejs.org/) (opcional, para compilar assets)
- [Git Bash](https://gitforwindows.org/) (opcional, recomendado en Windows)

---

## Instalación Paso a Paso

1. **Clona el repositorio**

   Abre tu terminal y ejecuta:
   ```bash
   git clone https://github.com/tu-usuario/tu-repo.git
   cd tu-repo
   ```

2. **Instala las dependencias de PHP**

   ```bash
   composer install
   ```

3. **Copia el archivo de entorno y configura tus variables**

   ```bash
   cp .env.example .env
   ```

   Luego edita el archivo `.env` y configura la conexión a tu base de datos:
   ```
   DB_DATABASE=nombre_de_tu_bd
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

4. **Genera la clave de la aplicación**

   ```bash
   php artisan key:generate
   ```

5. **Ejecuta las migraciones para crear las tablas**

   ```bash
   php artisan migrate
   ```

6. **(Opcional) Instala dependencias de frontend y compila assets**

   ```bash
   npm install
   npm run dev
   ```

7. **Inicia el servidor de desarrollo**

   ```bash
   php artisan serve
   ```

   El sistema estará disponible en [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Notas

- Si necesitas datos de ejemplo, puedes crear registros desde la interfaz web.
- Para generar PDFs, asegúrate de tener instalada la extensión `mbstring` de PHP.
- Si tienes problemas con permisos en Linux/Mac, puedes ejecutar:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

---

## Soporte

Si tienes dudas o problemas, comunícate con el equipo de desarrollo o revisa la [documentación de Laravel](https://laravel.com/docs)
