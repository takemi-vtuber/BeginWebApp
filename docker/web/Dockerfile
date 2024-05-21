# ベースイメージにAlmaLinux 8を指定
FROM php:8.1.16-apache

# 必要なパッケージをインストール
RUN apt update -y && apt install -y vim zip unzip
RUN apt install -y libonig-dev
RUN docker-php-ext-install pdo_mysql mysqli

RUN apt-get install -y libpng-dev libjpeg62-turbo-dev &&\
docker-php-ext-configure gd --with-jpeg &&\
docker-php-ext-install -j$(nproc) gd

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
# ADD：ローカルのファイルをDockerコンテナ内にコピーする
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_PID_FILE /var/run/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2

ADD ssl/server.crt /etc/pki/tls/certs/localhost.crt
ADD ssl/server.key /etc/pki/tls/private/localhost.key

RUN mkdir -p /run/php-fpm

#SSH
#RUN apt install -y openssh-server
#RUN mkdir /var/run/sshd
#RUN echo 'root:root123' | chpasswd
#RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
#
#EXPOSE 22
#
#CMD ["/usr/sbin/sshd", "-D"]