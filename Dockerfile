FROM php:8.3-apache

RUN apt-get update && apt-get install -y libonig-dev libxml2-dev libzip-dev zip && \
    docker-php-ext-install mbstring pdo pdo_mysql bcmath xml zip

RUN a2enmod rewrite

COPY . /var/www/html

WORKDIR /var/www/html/site

RUN apt-get update && apt-get install -y unzip curl && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer install --no-interaction --optimize-autoloader && \
    php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chown -R www-data:www-data /var/www/html/site/storage /var/www/html/site/bootstrap/cache

ENV APACHE_DOCUMENT_ROOT=/var/www/html/site/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
