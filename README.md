# **Cely Gossips**

> Status: Developed

Aplicativo para disponibilização de notícias

## Instalação

Como pré requisito é necessário ter o xamp e o composer instalado em sua máquina. Tendo isso pode-se clonar o projeto para executá-lo.

Após baixar o xamp ligue o phpmyadmin e o mysql e então crie um banco de dados com o nome "gossips"

Após isso abra o projeto e verifique se existe o arquivo de nome .env no diretorio base do projeto se não existir crie e copie as informações do arquivo .env.example para o .env e então execute os comandos no terminal:

```
composer install
```  
```
php artisan key:generate
```
```
php artisan migrate:fresh --seed
``` 
```
php artisan storage:link
```
```
php artisan serve
```

Após dar esses comandos é possivel abrir o app no seu navegador no endereço  [localhost:8000.](http://localhost:8000)

Devido aos comandos dados já existe um usuário cadastrado de com as informações
nome: cely
email: cely@gmail.com
senha: 123456789
