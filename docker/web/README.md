# 初期構築
下記コマンドで初期構築を実施
> docker-compose build
再構築を行う場合は、dockerのimageを削除が必要。

# 初期起動
## コンテナ起動
> docker-compse up -d
## コンテナにログイン
> docker exec -it smm_web bash
## HTTPをインストール
> dnf -y install httpd
## php-fpmを起動
> php-fpm
## httpdを起動
> httpd -k start

# Apacheのログファイルについて
/docker/web以下に出力されます
access.log  アクセスログ
error.log   エラーログ