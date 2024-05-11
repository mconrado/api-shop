#!/bin/sh

# Aguardar até que o serviço MySQL esteja pronto
while ! ncat -z db 3306; do
  sleep 1
done

composer install

# Executar a migração Yii2
yii migrate --interactive=0

chmod -R 777 ./
