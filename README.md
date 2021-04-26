# Teste de PHP

## Contato

[LinkedIn](https://www.linkedin.com/in/tsprates/)

## Requisitos:

* __PHP 7.4__
* __Laravel 8.0__
* __Bootstrap 4.5.2__
* __jQuery 3.5.1__
* __jQuery Validation 1.19.2__
* __jQuery Input Mask 1.14.16__

## Instalação:

* Instalação dos __pacotes PHP__ necessários:

```sh
composer install
```

* Criação do `APP_KEY`: 

```sh
php artisan key:generate
```

* Criação/migração das __tabelas do banco de dados__:

```sh
php artisan migrate
```

* Criação dos _links_ para os __arquivos anexados (_uploads_)__:

```sh
php artisan storage:link
```

> Para configurar o __servidor de email__ é necessário configurar a variável de ambiente `MAIL_FROM_ADDRESS` dentro de `.env`.
