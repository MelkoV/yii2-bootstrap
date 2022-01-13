FROM php:7.2-fpm

LABEL maintainer="ant-smorodin@ya.ru"

RUN apt-get update && apt-get install -y \
        curl \
        git \
        openssl \
        libssl-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libzip-dev \
        libgnutls-openssl27 \
    && docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install opcache \
    && docker-php-ext-install sockets \
    && docker-php-ext-install bcmath

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql


# Определим работу nginx+fpm через unixsocket, добавим переменную для логов в stdout
ADD docker/php/php.ini /usr/local/etc/php/conf.d/40-custom.ini
ADD docker/php/output.conf /usr/local/etc/php/conf.d/output.conf
ADD docker/php/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

COPY . /app
# Указываем рабочую директорию для PHP
WORKDIR /app

#ARG INSTALL_COMPOSERAUTH=0
#ARG INSTALL_ENV=prod

#RUN php install.php --env=${INSTALL_ENV:-prod} --composerauth=${INSTALL_COMPOSERAUTH}

# Запускаем контейнер
# Из документации: The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD ["php-fpm"]