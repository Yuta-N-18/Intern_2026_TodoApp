FROM php:8.4-fpm as base
WORKDIR /var/www

RUN apt-get update \
  && apt-get install -y zlib1g-dev mariadb-client vim libzip-dev git \
  && docker-php-ext-install zip pdo_mysql

#composer
COPY --from=composer:2.8.5 /usr/bin/composer /usr/bin/composer

#node
RUN apt-get -y install gnupg2
RUN curl -fsSL https://deb.nodesource.com/setup_lts.x | bash -
RUN apt-get -y install nodejs

FROM base as dev
# 今回dev用のステージしか書いてないですが、本来は本番用のステージも作る必要があります。
# FROM base as prod
# ～～本番用の設定～～