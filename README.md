# Teste PHP

### Versão de teste:

Uma versão funcional se encontra em: [Teste PHP](http://tsprates.com)

### Requisitos:

* __PHP 7.4__
* __Laravel 8.0__
* __Bootstrap 4.5.2__
* __jQuery 3.5.1__
* __jQuery Validation 1.19.2__
* __jQuery Input Mask 1.14.16__

### Instalação:

* Para __instalação dos pacotes PHP__ necessários para o projeto utilize o seguinte comando:

```
composer install
```

* Para a criação do `APP_KEY`, necessário para o Laravel digite o seguinte comando. __Observação__: o arquivo `.env` é criado a partir do arquivo `.env.backup` após a execução do passo anterior.

```
php artisan key:generate
```

* Para criação/migração das __tabelas do banco de dados__ utilize o comando abaixo:

```
php artisan migrate
```

* Finalmente, para configuração do __servidor de email__ utilizar o arquivo `.env` e configure a variável `MAIL_FROM_ADDRESS` para envio de email após a realização de cadastro do contato.
