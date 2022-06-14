# 🐳 Docker + PHP 8.1 + MySQL + Nginx + Symfony 6.1 Boilerplate

## Description

This is a complete stack for running Symfony 6.1 into Docker containers using docker-compose tool with [docker-sync library](https://docker-sync.readthedocs.io/en/latest/).

It is composed by 4 containers:

- `nginx`, acting as the webserver.
- `php`, the PHP-FPM container with the 8.0 version of PHP.
- `db` which is the MySQL database container with a **MySQL 8.0** image.
- `symfony_docker_app_sync` to sync files using library `docker-sync `.

## Installation

1. 😀 Clone this rep.

2. Create the file `./.docker/.env.nginx.local` using `./.docker/.env.nginx` as template. The value of the variable `NGINX_BACKEND_DOMAIN` is the `server_name` used in NGINX.

3. Go inside folder `./docker` and run `docker-sync-stack start` to start containers.

4. You should work inside the `php` container. This project is configured to work with [Remote Container](https://marketplace.visualstudio.com/items?itemName=ms-vscode-remote.remote-containers) extension for Visual Studio Code, so you could run `Reopen in container` command after open the project.

5. Inside the `php` container, run `composer install` to install dependencies from `/var/www/symfony` folder.

6. Use the following value for the DATABASE_URL environment variable:

```
DATABASE_URL=mysql://app_user:helloworld@db:3306/app_db?serverVersion=8.0.23
```

You could change the name, user and password of the database in the `env` file at the root of the project.

## To learn more

I have recorded a Youtube session explaining the different parts of this project. You could see it here:

[Boilerplate para Symfony basado en Docker, NGINX y PHP8](https://youtu.be/A82-hry3Zvw)
