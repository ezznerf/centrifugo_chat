FROM node:latest AS node
FROM php:8.2-fpm

COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Set working directory
WORKDIR /var/www/backend

# Install dependencies
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libpq-dev \
	libzip-dev \
	libxml2 \
	libxslt-dev \
	libonig-dev \
	libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install posgresql driver
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Install sockets
RUN docker-php-ext-install sockets

RUN docker-php-ext-install zip
RUN docker-php-ext-install xml
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install gd

ENV TZ=Europe/Moscow
RUN apt-get install tzdata
RUN echo "Europe/Moscow" > /etc/timezone

#Insatll wait-for-it.sh
RUN curl -o /usr/local/bin/wait-for-it.sh https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh && \
    chmod +x /usr/local/bin/wait-for-it.sh

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Change current user to www
USER www

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
