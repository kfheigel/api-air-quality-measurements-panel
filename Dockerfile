FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    nano \
    supervisor

RUN apt-get install -y --no-install-recommends \
    postgresql-client \
    librabbitmq-dev \
    libicu-dev \
    libpq-dev \
    libssl-dev \
    zlib1g-dev \
    libxml2-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        intl

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN git clone https://github.com/xdebug/xdebug.git
RUN cd xdebug && phpize && ./configure && make && make install

COPY docker/php/php-xdebug.ini /usr/local/etc/php/php.ini
COPY docker/nginx/conf.d/default.conf etc/nginx/conf.d

COPY docker/supervisor/conf.d/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /app

# CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
