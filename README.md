# Teste PHP

### Requisitos:

* __PHP 7.4__
* __Laravel 8.0__
* __Bootstrap 4.5.2__
* __jQuery 3.5.1__
* __jQuery Validation 1.19.2__
* __jQuery Input Mask 1.14.16__

### Instalação:

* Instalação dos __pacotes PHP__ necessários:

```
composer install
```

* Criação do `APP_KEY`: 

```
php artisan key:generate
```

* Criação/migração das __tabelas do banco de dados__:

```
php artisan migrate
```

* Criação dos _links_ para os arquivos anexados (_uploads_):

```
php artisan storage:link
```

> Para configurar do __servidor de email__ é necessário configurar a variável de ambiente `MAIL_FROM_ADDRESS` dentro de `.env`.
