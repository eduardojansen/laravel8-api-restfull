# API RestFull

Esse projeto contempla o desenvolvimento de uma API RESTful de cadastro de produtos para uma loja de confecção. Esse projeto foi desenvolvido Laravel 8 em um ambiente docker com PHP na versão 8.

## Requisitos para instalar a aplicação

- [Composer](https://getcomposer.org/download/)
- [Docker](https://docs.docker.com/get-docker/)
## Instalação 

Clone o repositório

```
$ git clone git@github.com:eduardojansen/laravel8-api-restfull.git
```
Depois de clonar o sistema, é necessário instalar as dependências.

```
$ cd laravel8-api-restfull
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

Para testar a API, basta utilizar um software como o Postman ou Insominia. Para informar o token procure a opção de Authentication e seleciona o tipo `Bearer Token`, e informe o token acima.

## Métodos
Requisições para a API devem seguir os padrões:
| Método | Descrição |
|---|---|
| `GET` | Retorna informações de um ou mais registros. |
| `POST` | Utilizado para criar um novo registro. |
| `PUT` | Atualiza dados de um registro. |
| `DELETE` | Remove um registro do sistema. |

## Respostas

| Código | Descrição |
|---|---|
| `200` | Requisição executada com sucesso (success).|
| `400` | Erros de validação ou os campos informados não existem no sistema.|
| `401` | Usuário não autenticado no sistema.|
| `404` | Registro pesquisado não encontrado (Not found).|
| `405` | Método não implementado.|
| `204` | indica que a solicitação foi bem sucedida. Utilizado após remoção com sucesso de um registro.|
| `422` | Erro de valiação. Dados informados estão fora do escopo definido para o campo.|

## Solicitando tokens de acesso [/oauth/access_token]

### Utilizando o código de acesso [POST]
Utilizando o `code` enviado pelo servidor de autorização, envie um POST com seus dados para receber um `access_token`.
O `access_token` é válido por 15 minutos. Utilize o `refresh_token` para solicitar um novo `access_token`, para não solicitar ao usuário suas credenciais (login e senha) novamente.

| Parâmetro | Descrição |
|---|---|
| `code` | Informar código único do produto |
| `name` | Informar nome único do produto. |
| `quantity` | Informar a quantidade do produto. |
| `size` | Informar o tamanho do produto |
| `composition` | Informar a composição do produto |


+ Request (application/json)

    + Body

            {
                "code": "99999",
                "name": "Kit Masculino",
                "quantity": "10",
                "size": "G",
                "composition": "Uma camisa e uma bermuda"
            }

+ Response 200 (application/json)

    + Body

            {
                "data": {
                    "code": "99999",
                    "name": "Kit Masculino",
                    "quantity": "10",
                    "size": "G",
                    "composition": "Uma camisa e uma bermuda"
                }
            }
