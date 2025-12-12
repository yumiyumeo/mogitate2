# 環境構築

## Docker ビルド

- git clone git@github.com:yumiyumeo/mogitate2.git
- DockerDesktop アプリを立ち上げる
- docker-compose up -d --build

## Laravel 環境構築

- ```
  docker-compose exec php bash
  ```
- ```
  composer install
  ```
- 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成
- .env に以下の環境変数を追加
  ```
  DB_CONNECTION=mysql
  DB_HOST=mysql
  DB_PORT=3306
  DB_DATABASE=laravel_db
  DB_USERNAME=laravel_user
  DB_PASSWORD=laravel_pass
  ```
- アプリケーションキーの作成
  ```
  php artisan key:generate
  ```
- マイグレーションの実行
  ```
  php artisan migrate
  ```
- シーディングの実行
  ```
  php artisan db:seed
  ```
