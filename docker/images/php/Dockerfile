FROM php:7.3-fpm-alpine
MAINTAINER Giuseppe Tazzi <giuseppe@gtgames.it>

ENV ENV="/etc/profile"

RUN apk update && \
    apk upgrade && \
    apk add --no-cache $PHPIZE_DEPS

RUN echo  http://dl-cdn.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories

RUN apk add --update --no-cache \
    git \
    bash \
    bash-completion \
    vim \
    shadow \
    su-exec \
    sudo \
    mysql-client

ADD profile /etc/profile


# Install composer + prestissimo
ARG COMPOSER
RUN if [ "$COMPOSER" = "1" ]; \
  then \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
      composer global require "hirak/prestissimo:^0.3"; \
  fi


# docker build --build-arg XDEBUG=1 if you want xdebug in the image
ARG XDEBUG
RUN if [ "$XDEBUG" = "1" ]; \
  then \
    pecl install xdebug-beta \
    && docker-php-ext-enable xdebug ; \
  fi

ADD conf.d/php.ini /usr/local/etc/php/
ADD conf.d/xdebug.ini  /usr/local/etc/php/conf.d/

WORKDIR /var/www

RUN chown -R www-data:www-data ./

ADD entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

WORKDIR /var/www/public

RUN chown -R www-data:users ./

ENTRYPOINT ["/entrypoint.sh"]

CMD ["php-fpm"]