FROM alpine:latest

RUN apk add --no-cache bash \
   && apk add wget \
   && apk add git \
   && apk add php7 \
   && apk add php7-json \
   && apk add php7-phar \
   && apk add php7-mbstring \
   && apk add php7-iconv \
   && apk add php7-ctype \
   && apk add php7-curl \
   && apk add php7-openssl \
   && apk add php7-xml \
   && apk add php7-simplexml \
   && apk add php7-dom \
   && apk add php7-session \
   && apk add php7-xmlwriter \
   && apk add php7-tokenizer \
   && apk add php7-pdo \
   && apk add php7-pecl-xdebug

ADD xdebug.ini /etc/php7/conf.d/xdebug.ini
RUN mkdir -p /var/application
RUN adduser --disabled-password musement && chown -R musement:musement /var/application

# Composer
RUN wget https://getcomposer.org/installer -O composer-setup.php
RUN php composer-setup.php
RUN rm composer-setup.php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

USER musement
WORKDIR /var/application

RUN echo "alias ll='ls -l'" >> ~/.bashrc
RUN echo "alias la='ls -la'" >> ~/.bashrc
