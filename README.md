## Pasos para ejecutar el sistema

### Clonar el repositorio de git
- Clonar el proyecto con el comando git clone https://github.com/achita-10/ceop.git

### Crear el archivo .env
- El archivo .env nos permite alamacenar las variables de entorno y definir datos como nombre, usuario y contraseña que tendra la base de datos, para crearlo usar el siguiente comando en la raiz del proyecto: cp .env.example .env

### Ejecutar los siguientes comandos en la raiz del proyecto 
- Para instalar composer: composer install
- Para instalar el gestor de paquetes: npm install

## Configurar la Base de Datos

### Crear la BD
- crear la bd definida en el archivo .env en el gestor de base de datos, se recomienda phpmyadmin

### Crear las tablas
- Con el siguiente comando se van a crear las tablas de la bd: php artisan migration

### Crear usuario administrador
- Primeramente se debe crear un registro en la tabla usuario de la bd
- Posteriormente crear el usuario para iniciar sesión ejecutando el siguiente comando en la raiz del proyecto: php artisan db:seed
- El cual define por defecto como usuario: admin y contraseña: admin



# Atlantis-Lite

![](http://themekita.com/assets/images/atlantislite.png)

Free Bootstrap 4 Admin Dashboard

Atlantis Lite is a free bootstrap 4 admin dashboard that is beautifully and elegantly designed to display various metrics, numbers or data visualization.

Atlantis Lite admin dashboard has 2 layouts, many plugins and UI components to help developers create dashboards quickly and effectively so they can save development time and also help users to make the right and fast decisions based on existing data.

We made documentation how you started using this dashboard template and use available components and plugins.
#
