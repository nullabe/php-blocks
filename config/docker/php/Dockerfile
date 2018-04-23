FROM php:7.1-fpm

# Var init.
ARG UID
ARG GID

# Common packages.
RUN apt-get update && apt-get install -y \
    openssl \
    git \
    unzip

# Composer installation.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Rights managements
RUN usermod -u $UID www-data
RUN groupmod -g $GID www-data