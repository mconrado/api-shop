#!/bin/bash

echo Subindo a aplicação docker 
docker compose --env-file .env up --build -d


echo API SHOP pronta!!!
 
