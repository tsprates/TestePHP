# Teste PHP

### Requisitos:

* __PHP 7.4__
* __Laravel 8.0__
* __Bootstrap 4.5.2__
* __jQuery 3.5.1__
* __jQuery Validation 1.19.2__
* __jQuery Input Mask 1.14.16__

### Instalação:

* Para __instalação dos pacotes PHP necessários__. Utilize o seguinte comando:

```
composer install
```

* Para a criação do `APP_KEY`, necessário para o Laravel digite o seguinte comando. 
> __Observação__: o arquivo `.env` é criado a partir do arquivo `.env.backup` após a execução do passo anterior.

```
php artisan key:generate
```

* Para criação/migração das __tabelas do banco de dados__:

```
php artisan migrate
```

* Para criação dos links para os arquivos anexados:

```
php artisan storage:link
```

* Por fim, para configuração do __servidor de email__ utilizar o arquivo `.env`. Utilize a variável `MAIL_FROM_ADDRESS` para envio de email após a realização de cadastro.
