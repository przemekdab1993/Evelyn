FROM php:8.0-fpm

RUN apt-get update && \

apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev libpng-dev && \
pecl install apcu && \
docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql gd && \
docker-php-ext-enable apcu pdo_pgsql sodium && \
apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /code

CMD composer i -o ; php-fpm

EXPOSE 9000