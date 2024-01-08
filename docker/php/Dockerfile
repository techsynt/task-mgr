FROM php:8.2-fpm

#Set the working dir
WORKDIR /var/www/task-mgr

#Install symfony dependencies
RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql  \
    && docker-php-ext-install intl pdo_pgsql pgsql opcache \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#Install symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install -y symfony-cli