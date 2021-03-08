FROM demidovich/php-fpm:7.4-alpine

ARG UID=82
ARG GID=82

ENV UID=${UID:-82} \
    GID=${GID:-82} \
    PHP_COMPOSER_VERSION=2.0.9

RUN set -eux; \
    if [ $UID -ne 82 ]; then \
        usermod -u ${UID} www-data; \
    fi; \
    if [ $GID -ne 82 ]; then \
        groupmod -g ${GID} www-data; \
    fi; \
    cp -f "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"; \
    install-composer.sh $PHP_COMPOSER_VERSION; \
    chown -R www-data:www-data /composer; \
    wget https://github.com/vimeo/psalm/releases/latest/download/psalm.phar -O /usr/local/bin/psalm; \
    chmod +x /usr/local/bin/psalm;
    # docker-php-ext-enable xdebug;

RUN chmod u+s /usr/local/sbin/php-fpm

USER "www-data"

WORKDIR /app

CMD ["/usr/local/sbin/php-fpm", "-F" ]

EXPOSE 9000
