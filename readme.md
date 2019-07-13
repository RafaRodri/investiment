<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Sobre o projeto

Sistema para gestão de grupos de investimento, que visam maiores benefícios dos bancos em relação aos investimentos individuais.

##### Login
<img border="3" src="public/prints/1-login.png">

##### CRUD Usuários
<img border="3" src="public/prints/2-users.png">

##### CRUD Instituições
<img border="3" src="public/prints/3-institutions.png">

##### CRUD Grupos e Relacionar Usuários ao mesmo
<img border="3" src="public/prints/4-groups.png">
<img border="3" src="public/prints/4-groups-relation.png">

##### CRUD Produtos
<img border="3" src="public/prints/5-product.png">

##### Realizar aplicações
<img border="3" src="public/prints/6-application.png">

##### Realizar saques
<img border="3" src="public/prints/7-withdraw-1.png">
<img border="3" src="public/prints/7-withdraw-2.png">

##### Consultar saldo do seus produtos
<img border="3" src="public/prints/8-applications.png">

##### Consultar extrato
<img border="3" src="public/prints/9-extract.png">


## Passo a Passo
* Execute o comando <code>$ composer.install</code>
* Configure o arquivo <code>.env</code>
* Crie DB com o nome indicado no arquivo <code>.env</code>
* Execute o comando <code>$ php artisan migrate --seed</code>

<br>

###### Ao executar o projeto, caso ocorrra um erro relacionado a "supported ciphers":
* Execute o comando <code>$ php artisan key:generate</code>
* E limpe o cache, com <code>$ php artisan config:clear</code>