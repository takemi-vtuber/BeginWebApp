# ベースイメージにAlmaLinux 8を指定
#FROM ubuntu/apache2
FROM php:8.1.16-apache

# 必要なパッケージをインストール
RUN apt update -y && apt install -y vim
RUN apt install -y libonig-dev
RUN docker-php-ext-install pdo_mysql mysqli
#RUN apt -y install php8.1 php8.1-intl php8.1-mbstring php8.1-mysql php8.1-gd php8.1-fpm
#RUN apt -y install libapache2-mod-php

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
# ADD：ローカルのファイルをDockerコンテナ内にコピーする
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

ADD ssl/server.crt /etc/pki/tls/certs/localhost.crt
ADD ssl/server.key /etc/pki/tls/private/localhost.key

RUN mkdir -p /run/php-fpm