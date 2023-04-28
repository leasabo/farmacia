FROM php:7.3-apache

###########################################################################
# ENVIRONMENT
###########################################################################
ARG ENV=production
ENV ENV=${ENV}

###########################################################################
# APACHE CONFIG
###########################################################################
RUN a2enmod rewrite
RUN a2enmod headers

# Always run apt update when start and after add new source list, then clean up at end.
RUN set -xe; \
	apt-get update -yqq && \
	pecl channel-update pecl.php.net && \
	apt-get install -yqq \
	apt-utils \
	libzip-dev zip unzip \
	nano vim

###########################################################################

ARG TZ=UTC
ENV TZ ${TZ}

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

###########################################################################
# EXTENSIONS
###########################################################################
RUN docker-php-ext-install \
	zip \
	mysqli \
	pdo_mysql

###########################################################################
# COMPOSER
###########################################################################
COPY --from=composer:2.0.8 /usr/bin/composer /usr/bin/composer
RUN mkdir /var/www/.composer
RUN chown -R www-data:www-data /var/www/.composer
RUN chmod 777 -R /var/www/.composer
RUN chmod 757 -R /tmp

###########################################################################
# GIT
###########################################################################
RUN apt update && apt install -y git git-flow

###########################################################################
# PHP INI
###########################################################################
COPY ./php.ini /usr/local/etc/php/php.ini
COPY ./server.sh /
RUN chmod +x /server.sh
