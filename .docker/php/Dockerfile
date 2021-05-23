FROM php:7.4-fpm

WORKDIR /app

ARG gid=1000
ARG uid=1000
ARG group=app

ADD ./zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

ENV COMPOSER_HOME /composer

RUN addgroup --gid ${gid} ${group} && \
    useradd -u ${uid} -g ${group} -s /bin/bash ${group} && \
    mkdir /var/run/php $COMPOSER_HOME && \
    chown -R ${gid}:${uid} /usr/local /var/run /var/run/php $COMPOSER_HOME && \
    apt-get update -y && apt-get install -y git && \
    rm -rf /var/cache/apt/* /var/lib/dpkg/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

VOLUME /var/run/php

USER app
