FROM php:7.4-apache

WORKDIR /var/www/html

# COPY ../ .

RUN pecl install -o -f redis \
docker-php-ext-enable redis

# RUN docker-php-ext-install redis

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install system dependencies
# RUN apt-get update && apt-get install -y \
#     git \
#     curl \
#     libpng-dev \
#     libonig-dev \
#     libxml2-dev \
#     zip \
#     unzip

# Clear cache
# RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# RUN docker-php-ext-install pdo pdo_mysql mysqli mbstring exif pcntl bcmath gd
# RUN docker-php-ext-enable pdo pdo_mysql mysqli mbstring exif pcntl bcmath gd

# RUN chmod 777 -R /var/www/html/storage/ && \
#     chown -R www-data:www-data /var/www/

RUN a2enmod rewrite

EXPOSE 80/tcp

CMD ["apache2-foreground"]
