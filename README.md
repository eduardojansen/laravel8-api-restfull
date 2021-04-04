# API RestFull

Esse projeto contempla o desenvolvimento de uma API RESTful de cadastro de produtos para uma loja de confecção. Esse projeto foi desenvolvido Laravel 8 em um ambiente docker com PHP na versão 8.

## Requisitos para instalar a aplicação

- [Composer](https://getcomposer.org/download/)
- [Docker](https://docs.docker.com/get-docker/)
## Instalação 

Clone o repositório

```
$ git clone https://github.com/
```
Depois de clonar o sistema, é necessário instalar as dependências.

```
$ cd laravel8-project-vesti
$ composer install
```
## Executando Laravel Sail

Para gerenciar o ambiente Docker com o Sail é bem simples, basta acessar o `./vendor/bin/sail` e em seguida o comando que você precisa executar.

O comando para “subir” o ambiente Docker do Laravel Sail é:

```
vendor/bin/sail up
```

Para rodar em background
```
vendor/bin/sail up -d
```

Para parar o servidor basta teclar `ctrl+c` ou, se estiver rodando em background, o comando `vendor/bin/sail down`.

Para acessar o projeto no navegador, basta acessar `http://localhost/`

Executar o comando Seed para que seja criado o usuário de testes da aplicação

```
vendor/bin/sail artisan db:seed
```

Todos os endpoints da API são acessíveis apenas para usuários autenticados. O usuário possui um token e esse token precisa ser enviado no cabeçalho de cada requisição, caso contrário será retornando um erro HTTP `401`.

API Token para testes
```
fKXxVoVBbNcEm1sGcAW0S0hbCcro5C6AnCdPI56dXYNJmuSbv8wlPRCAN5DKKtFm17K55Y7F9OJXDONp
```

Para testar a API, basta utilizar um software como o Postman ou Insominia. Para informar o token procure a opção de Authentication e seleciona o tipo `Bearer Token`, e cole o token e cole o token acima.
