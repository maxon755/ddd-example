FROM php:8.1-cli-alpine

ARG USER_UID=33
ARG USER_GID=33

ENV TERM xterm-256color

ENV PROJECT_DIR="/code"

RUN apk add -U shadow libzip-dev git unzip bash

RUN usermod -u "$USER_UID" www-data
RUN groupmod -g "$USER_GID" www-data

RUN mkdir "$PROJECT_DIR" && chown www-data:www-data "$PROJECT_DIR"
RUN chown -R www-data:www-data /var/www

# extensions
RUN docker-php-ext-install pdo pdo_mysql zip sockets

# redis
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis.so

# xdebug
RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
    && pecl install xdebug-3.1.5 && docker-php-ext-enable xdebug
COPY .docker/php/configs/xdebug.ini "$PHP_INI_DIR"/conf.d/

# composer
COPY --from=composer:2.3 /usr/bin/composer /usr/local/bin/composer

# roadrunner
COPY --from=ghcr.io/roadrunner-server/roadrunner:2.10.7 /usr/bin/rr /usr/local/bin/rr

WORKDIR "$PROJECT_DIR"

USER www-data
