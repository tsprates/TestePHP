# Teste PHP

### Versão de teste:

Uma versão funcional se encontra em: [Teste PHP](http://tsprates.com)

### Requisitos:

* PHP 7.4
* Laravel 8.0
* Bootstrap 4.5.2
* jQuery 3.5.1
* jQuery Validation 1.19.2
* jQuery Input Mask 1.14.16

### Instalação:

* Para __instalação dos pacotes PHP__:

```
composer install
```

* Criação do __APP_KEY__ necessário para o Laravel:

```
php artisan key:generate
```

* Para criação das __tabelas do banco de dados__:

```
php artisan migrate
```

* Para configuração do __servidor de email__ utilizar o arquivo `.env` e utilize a variável `MAIL_FROM_ADDRESS` para envio de email após a realização de cadastro. *Observação*: criado a partir do arquivo `.env.backup`.
