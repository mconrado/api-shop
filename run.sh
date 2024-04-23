#!/bin/bash

echo Subindo a aplicação docker 
docker compose --env-file .env up --build -d

#echo Instalando dependências
#docker run --rm --interactive --tty -v $PWD/api-starwars:/app composer install

#docker compose --env-file .env up -d
docker exec yii2-apishop composer self-update --1

echo Acesse do navegador: http://localhost:8000
 
