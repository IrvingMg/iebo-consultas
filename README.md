# Sistema de consultas

Aplicación web para la consulta de información del IEBO y el seguro facultativo del IMSS.

## Configuración

Para ejecutar el proyectos de forma local seguir las siguientes instrucciones:

### Requisitos

* [XAMPP](https://www.apachefriends.org/es/index.html).
* [Laravel 5.8](https://laravel.com).
* [Composer](https://getcomposer.org/).

### Instalación

1. Clonar repositorio

    ```bash
    git clone https://github.com/IrvingMg/iebo-consultas.git
    ```

2. Crear una nueva base de datos en MySQL.

3. Utilizando la shell de XAMPP, importar la información de afiliados a la nueva base de datos creada

    ```none
    mysql -u nombre_usuario -p <nombre_base_de_datos < <datos_afiliados>
    ```

4. Renombrar el archivo `.env.example` como `.env`

5. Configurar la conexión con la base de datos en el archivo `.env`

    ```none
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE= nombre_base_de_datos
    DB_USERNAME= nombre_usuario
    DB_PASSWORD= password
    ```

6. Instalar dependencias

    ```bash
    composer install
    ```

7. Ejecutar el comando

```bash
php artisan key:generate
```

## Uso

```bash
php artisan serve
```
