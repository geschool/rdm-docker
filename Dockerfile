FROM php:7.2-apache



# extension
RUN apt-get update \
    && apt-get install -y \
        zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli 


# ioncube loader
RUN curl -fSL 'http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz' -o ioncube.tar.gz \
    && mkdir -p ioncube \
    && tar -xf ioncube.tar.gz -C ioncube --strip-components=1 \
    && rm ioncube.tar.gz \
    && mv ioncube/ioncube_loader_lin_7.2.so /var/www/ioncube_loader_lin_7.2.so \
    && rm -r ioncube
# php.ini
COPY conf/php.ini /usr/local/etc/php/
COPY conf/env.conf /etc/apache2/conf-enabled/environment.conf

#rdm
ADD RDMhosting.zip /var/www/html/
RUN unzip /var/www/html/RDMhosting.zip
RUN rm /var/www/html/RDMhosting.zip

#config
COPY conf/config.php /var/www/html/

RUN a2enmod rewrite
RUN a2enmod ssl

# apache user
RUN usermod -u 1000 www-data \
    && groupmod -g 1000 www-data