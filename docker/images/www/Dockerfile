FROM php:8.0-apache
LABEL maintainer 'David Marcelo Góis Silva <emarpel@gmail.com>'

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y git unzip zip

WORKDIR /var/www/html/

COPY . .

EXPOSE 80

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache calendar mysqli

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer

RUN chown -R www-data:www-data /var/www

RUN touch /usr/local/etc/php/conf.d/php.ini \
    && echo "max_execution_time  = 4000" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "memory_limit = 4000M" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "upload_max_filesize = 400M" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "max_file_uploads = 5" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "output_buffering = On" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "display_errors = Off" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "short_open_tag = On" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "mysql.default_socket = /path/to/mysql.sock" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "mysql.default_socket = /path/to/mysqli.sock" >> /usr/local/etc/php/conf.d/php.ini \
    && echo "default_charset = UTF-8" >> /usr/local/etc/php/conf.d/php.ini
    