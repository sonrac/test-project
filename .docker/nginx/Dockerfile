FROM nginx:1.9

ARG gid=1000
ARG uid=1000
ARG group=app

ADD ./nginx.conf /etc/nginx/conf.d/default.conf

RUN addgroup --gid ${gid} ${group} && \
    useradd -u ${uid} -g ${group} -s /bin/bash ${group} && \
    chown -R ${gid}:${uid} /etc/nginx /var/cache /var/run /run /var/log

RUN sed -i 's#user  nginx;#user app app;#i' /etc/nginx/nginx.conf

WORKDIR /app

VOLUME /var/run/php

USER app
