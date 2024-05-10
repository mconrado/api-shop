# API SHOP

Sistema de API de produtos e clientes.

*Docker, MySQL 8.4, Composer v1, Yii2 e PHP 7.1*


## INSTALAÇÃO
1. Clone o repositório.
2. Copie o arquivo .env-sample, salve como .env e defina as variáveis de ambiente.
3. Copie o arquivo .ini-sample.sql, salve como init.sql, coloque a senha do user root do banco configurada no .env.
4. Rode o run.sh (Linux).

```console
git clone git@github.com:mconrado/api-shop.git
sh run.sh
```

Ou em outro OS:
```console
docker compose --env-file .env up --build -d
```
5. Rode os testes.
```console
docker exec -it yii2-apishop codecept run unit
docker exec -it yii2-apishop codecept run functional
```
## UTILIZAÇÃO

### Criando usuário via bash:
```console
docker exec -it yii2-apishop yii create-user "<username>" "<name>" "<password>"
```

### URLs de acesso API:

| AÇÃO                                   |             URL          |
|----------------------------------------|---------------------------|
| **LOGIN**                              | [api/auth/login](http://localhost:8000/api/auth/login)
|
| **CADASTRO DE CLIENTES**               | [api/customer/save](http://localhost:8000/api/customer/save)
|
|
| **CONSULTA DE CLIENTES**               | [api/customer](http://localhost:8000/api/customer)
|
|
| **CADASTRO DE PRODUTOS**               | [api/product/save](http://localhost:8000/api/product/save)
|
|
| **CONSULTA DE PRODUTOS**               | [api/product](http://localhost:8000/api/product)
|
|
| **CONSULTA DE PRODUTOS DE UM CLIENTE** | [api/customer/1/products](api/customer/1/products)
|

##### **Ou importe o arquivo postman.json no Postman.*

**Nota: na migração é carregado alguns dados para exemplo.* 







