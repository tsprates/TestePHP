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

* Para __instalação dos pacotes PHP__:

```
composer install
```

* Criação do `APP_KEY` necessário para o Laravel. *Observação*: o arquivo `.env` é criado a partir do arquivo `.env.backup` após a instalação do passo anterior.

```
php artisan key:generate
```

* Para criação/migração das __tabelas do banco de dados__:

```
php artisan migrate
```

* Para configuração do __servidor de email__ utilizar o arquivo `.env` e utilize a variável `MAIL_FROM_ADDRESS` para envio de email após a realização de cadastro.
