# examenpractivo
Examen practico solicitado para entrevista



## Tech
* [Docker] - Proyecto de código abierto que automatiza el despliegue de aplicaciones dentro de contenedores de software

* [Laravel] - Framework de código abierto para desarrollar aplicaciones y servicios web con PHP 5, PHP 7 y PHP 8. 

* [Nginx] - Servidor web/proxy inverso ligero de alto rendimiento y un proxy para protocolos de correo electrónico

* [Php] - Lenguaje de programación de uso general que se adapta especialmente al desarrollo web.


* [MySQL] -  Es un sistema de gestión de bases de datos relacional desarrollado bajo licencia dual: Licencia pública general/Licencia comercial por Oracle Corporation


* [Github] -  Forja para alojar proyectos utilizando el sistema de control de versiones Git.


​
# instalación
Es importante contar con [Docker]

Una vez clonado el repositorio se debera correr el siguiente comando para levantar el contenedor

```sh
$ cd /path/to/proyect/laradock
$ docker-compose up -d
```

Posteriormente se tendra que instalar la paquetería de laravel

```sh
$ cd /path/to/proyect/laradock/src
$ composer install
```

Una vez finalizado composer se debe migrar la base de datos

```sh
$ cd /path/to/proyect/laradock/src
$ docker-compose exec php php /var/www/html/artisan migrate
```

Y para finalizar se debe correr el archivo que genera la encriptación 
```sh
$ cd /path/to/proyect/laradock/src
$ docker-compose exec php php /var/www/html/artisan jwt:secret
```

[Docker]: <https://www.docker.com>
[Laravel]: <https://laravel.com/docs/8.x>
[Nginx]: <https://www.nginx.com>
[Php]: <https://www.php.net/manual/es/intro-whatis.php>
[MySQL]: <https://www.mysql.com>
[Github]: <https://github.com>

