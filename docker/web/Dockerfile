# ベースイメージにAlmaLinux 8を指定
#FROM ubuntu/apache2
FROM php:8.1.16-apache

# 必要なパッケージをインストール
RUN apt update -y && apt install -y vim
RUN apt install -y libonig-dev
RUN docker-php-ext-install pdo_mysql mysqli
# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
# ADD：ローカルのファイルをDockerコンテナ内にコピーする
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/apache2/sites-enabled/

ADD ssl/server.crt /etc/pki/tls/certs/localhost.crt
ADD ssl/server.key /etc/pki/tls/private/localhost.key

RUN mkdir -p /run/php-fpm

#SSH
RUN apt install -y openssh-server
RUN mkdir /var/run/sshd
RUN echo 'root:root123' | chpasswd
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config

EXPOSE 22

CMD ["/usr/sbin/sshd", "-D"]