# Sistema de consultas
Aplicación web para la consulta de información del IEBO y el seguro facultativo del IMSS.

## Comenzando
Para ejecutar el proyectos de forma local seguir las siguientes instrucciones:

### Requisitos
* Instalar [XAMPP](https://www.apachefriends.org/es/index.html).
* Instalar [Composer](https://getcomposer.org/).

### Instalación
1. Clonar repositorio
```
git clone https://github.com/IrvingMg/IEBOSistemaConsultas-App
```

2. Copiar archivo `.env.example` y renombrarlo como `.env`

3. Abrir archivo `.env` y configurar la conexión con la base de datos 
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

4. Instalar dependencias
```
composer install
```

5. Ejecutar el comando
```
php artisan key:generate
```

6. Ejecutar migraciones
```
php artisan migrate
```

7. Ejecutar proyecto localmente
```
php artisan serve
```

## Construido con
* [Laravel 5.8](https://laravel.com) - PHP Framework.