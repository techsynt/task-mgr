FROM php:8.2-fpm

#Set the working dir
WORKDIR /var/www/task-mgr

#Install symfony dependencies
RUN apt-get update && \
    apt-get install -y libpq-dev g++ git libicu-dev zip libzip-dev && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install zip pdo_pgsql pgsql opcache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#Install symfony CLI
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install -y symfony-cli