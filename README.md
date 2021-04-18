# Projeto

Esse projeto contempla o desenvolvimento de uma API RESTful de cadastro simples de produtos, usando Laravel 8 em um ambiente docker com PHP na versão 8.

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
$ docker run --rm --interactive --tty --volume $PWD:/app composer install
```
## Executando Laravel Sail

Para gerenciar o ambiente Docker com o Sail, basta excutar o arquivo `./vendor/bin/sail` e em seguida o comando que você precisa executar.

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

## Testando API

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

Adicionar no Header das requisições:
* Content-Type
   * application/json
* Accept
   * application/json

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

## API de Produtos

### Cadastrando produto [POST]
Os campos obrigatórios para cadastro do produto são `name` e `code` e ambos são únicos, pois não podem ser repetidos no sistema.

Endpoint:
```
POST http://localhost/api/v1/products
```

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
                    "composition": "Uma camisa e uma bermuda",
                    "updated_at": "2021-04-04T14:34:27.000000Z",
                    "created_at": "2021-04-04T14:34:27.000000Z",
                    "id": 3
                }
            }

### Editando produto [PUT]

Exemplo de atualização apenas do código de um produto.

Endpoint:
```
PUT http://localhost/api/v1/products/ID-PRODUCT
```

+ Request (application/json)

    + Body

            {
                "code": "8888",
            }

+ Response 200 (application/json)

    + Body

            {
                "data": {
                    "code": "8888",
                    "name": "Kit Masculino",
                    "quantity": "10",
                    "size": "G",
                    "composition": "Uma camisa e uma bermuda",
                    "updated_at": "2021-04-04T14:34:27.000000Z",
                    "created_at": "2021-04-04T14:34:27.000000Z",
                    "id": 3
                }
            }


### Exibindo um produto [GET]

Endpoint:
```
GET http://localhost/api/v1/products/ID-PRODUCT
```
+ Response 200 (application/json)

    + Body

            {
                "data": [
                    {
                        "id": 1,
                        "name": "Kit Masculino",
                        "code": "999",
                        "size": "G",
                        "composition": "Uma camisa e uma bermuda",
                        "quantity": 5,
                        "created_at": "2021-04-04T15:35:57.000000Z",
                        "updated_at": "2021-04-04T15:35:57.000000Z"
                    }
                ]
            }

### Listando produtos [GET]

Endpoint:
```
GET http://localhost/api/v1/products
```
+ Response 200 (application/json)

    + Body

            {
                "data": [
                    {
                        "id": 1,
                        "name": "Kit Masculino",
                        "code": "999",
                        "size": "G",
                        "composition": "Uma camisa e uma bermuda",
                        "quantity": 5,
                        "created_at": "2021-04-04T15:35:57.000000Z",
                        "updated_at": "2021-04-04T15:35:57.000000Z"
                    },
                    {
                        "id": 2,
                        "name": "Kit Feminino",
                        "code": "888",
                        "size": "G",
                        "composition": "Uma camisa e uma bermuda",
                        "quantity": 10,
                        "created_at": "2021-04-04T15:36:55.000000Z",
                        "updated_at": "2021-04-04T15:36:55.000000Z"
                    }
                ]
            }

### Removendo produto [DELETE]

Endpoint:
```
DELETE http://localhost/api/v1/products/ID-PRODUCT
```
+ Response 204 (No Content)

## Logs

Todos os logs de alterações nos registros estão sendo armazenadas na tabela `activity_log`
