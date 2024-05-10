# BeginWebApp
Youtube　１からはじめるWebアプリ　企画で作成したコードを公開しています。

https://www.youtube.com/watch?v=1dpDj7iNLD4&amp;list=PLFe6d4Ry2oAYR4OMGQBeAu7eNkroRqx28&amp;pp=iAQB

docker Desktopがインストールされている場合
    本リポジトリをクローンした後に
    > docker-compose build
        buildは初回のみ
    > docker-compose up -d
    を実行頂くとWebサーバー、DBサーバのコンテナを構築、実行頂けます。
    正常に終了したら
    http://localhost:8001/
    にブラウザでアクセス頂くとコンテナのWebサーバーの表示ができます。
    各動画毎にナンバリングを行っているので
    http://localhost:8001/010/
    にアクセスすると動画＃10の内容を表示確認頂けます。

    Webサーバを停止するときは
    > docker-compose stop

    再開するときは
    > dokcer-compose start