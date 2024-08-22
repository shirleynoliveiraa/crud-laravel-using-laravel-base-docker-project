FROM php:8.1.0-apache

WORKDIR /var/www/html

# Mod Rewrite
RUN a2enmod rewrite

# Linux Library
RUN apt-get update -y && apt-get install -y \
  libicu-dev \
  libmariadb-dev \
  unzip zip \
  zlib1g-dev \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer 

# PHP extensions
RUN docker-php-ext-install gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd

# Set the Apache DocumentRoot to Laravel's public directory
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY ./laravel-app /var/www/html

# Permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
