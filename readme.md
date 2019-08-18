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

2. Crear una nueva base de datos en MySQL.

3. Utilizando la shell de XAMPP, importar las tablas del archivo `iebo_app.sql` en la nueva base de datos creada 
```
mysql -u nombre_usuario -p nombre_base_de_datos < ruta/iebo_app.sql
```

4. Renombrar el archivo `.env.example` como `.env`

5. Configurar la conexión con la base de datos en el archivo `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= nombre_base_de_datos
DB_USERNAME= nombre_usuario
DB_PASSWORD= password
```

6. Instalar dependencias
```
composer install
```

7. Ejecutar el comando
```
php artisan key:generate
```

8. Ejecutar proyecto localmente
```
php artisan serve
```

## Construido con
* [Laravel 5.8](https://laravel.com) - PHP Framework.