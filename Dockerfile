FROM yiisoftware/yii2-php:7.1-apache
RUN apt-get update && apt-get install -y ncat

WORKDIR /app
COPY . /app

RUN composer self-update --1

COPY wait-for-mysql.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/wait-for-mysql.sh

CMD ["sh", "-c", "/usr/local/bin/wait-for-mysql.sh & apache2-foreground"]
