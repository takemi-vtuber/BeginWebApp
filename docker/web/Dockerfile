# ベースイメージにAlmaLinux 8を指定
FROM almalinux:9

# 必要なパッケージをインストール
#RUN dnf -y update && \
#    dnf -y install epel-release && \
#    dnf -y install httpd php php-cli php-common php-mbstring php-xml php-pdo php-mysqlnd
RUN dnf -y update 
RUN dnf -y install httpd mod_ssl
RUN dnf -y install epel-release
# RUN dnf -y install https://rpms.remirepo.net/enterprise/remi-release-8.rpm
RUN dnf -y install dnf-utils http://rpms.remirepo.net/enterprise/remi-release-9.rpm
RUN dnf -y module -y reset php
RUN dnf -y module enable php:remi-8.1
RUN dnf -y install php php-cli php-mysqlnd

# 設定ファイルをdockerコンテナ内のPHP、Apacheに読み込ませる
# ADD：ローカルのファイルをDockerコンテナ内にコピーする
ADD php.ini /usr/local/etc/php/
ADD 000-default.conf /etc/httpd/conf.d/

ADD ssl/server.crt /etc/pki/tls/certs/localhost.crt
ADD ssl/server.key /etc/pki/tls/private/localhost.key

RUN mkdir -p /run/php-fpm