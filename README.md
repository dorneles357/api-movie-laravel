## API Appmovie


## Como Funciona?


## Autentificação


## Organize seus videos com tags


## Como Usar?
### Login de usuários

### Cadastro e upload de videos curtos

### Adicione Tags para seus videos


## Rodando A API
Primeiramente, clone o repositório para sua máquina local. Será necessário ter o docker e docker-compose instalado em seu computador.

       //link para clone

Suba os containers do projeto
```sh
docker-compose up -d
```


Acessar o container
```sh
docker-compose exec laravel_8 bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```


Perfeito! Rode o comando abaixo e pronto! Aplicação no ar!
  
     php artisan serve

Acesse o projeto
[http://localhost:8180](http://localhost:8180/api/)
 

## Rode a Api junto com uma interface gráfica


