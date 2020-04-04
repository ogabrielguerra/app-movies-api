FROM microweber/php74-apache
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
RUN apt-get update -y && apt-get install -y libpng-dev curl libcurl4-openssl-dev zip unzip git

RUN docker-php-ext-install pdo pdo_mysql gd curl
RUN a2enmod rewrite
RUN service apache2 restart