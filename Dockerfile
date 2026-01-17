FROM php:7.4-apache

# Aktifkan mod rewrite
RUN a2enmod rewrite

# Install ekstensi MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set document root ke project CI
ENV APACHE_DOCUMENT_ROOT /var/www/html

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

WORKDIR /var/www/html

COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
