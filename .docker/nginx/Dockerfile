FROM nginx:1.9

ADD ./nginx.conf /etc/nginx/conf.d/default.conf

RUN sed -i 's#user  nginx;#user www-data www-data;#i' /etc/nginx/nginx.conf
WORKDIR /app

VOLUME /var/run/php
