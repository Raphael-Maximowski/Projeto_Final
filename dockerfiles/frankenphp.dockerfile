FROM dunglas/frankenphp

RUN mkdir -p /var/www/html

WORKDIR /var/www/html

RUN install-php-extensions pcntl sockets pdo_mysql zip \
    && apt-get update \
    && apt-get install -y git unzip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html

ENTRYPOINT ["sh", "-c", "composer update && php artisan octane:start --server=frankenphp --port=9804 --host=0.0.0.0"]