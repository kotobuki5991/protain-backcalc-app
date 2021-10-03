FROM php:7.4.22-apache

WORKDIR /var/www/html

# PHP実行・デバッグ用、MySQL連携用、作業用で必要なライブラリをインストール
# パッケージリストの更新
RUN apt-get update \
    # 引数に指定したパッケージ、コマンドのインストール（-yは問い合わせに全てyと答える）
    && apt-get install -y libonig-dev libzip-dev unzip \
    # PHPの拡張機能をインストール（mbstring・・・PHPでマルチバイト文字使用可）
    # （zip・・・zip拡張モジュール）（bcmath・・・少数を扱う）
    && docker-php-ext-install pdo_mysql mbstring zip bcmath \
    # peclを経由してxdebugインストール
    && pecl install xdebug \
    # pecl経由で導入した拡張機能を有効にする
    && docker-php-ext-enable xdebug

# 設定ファイルをコピー
COPY ./php/php.ini /usr/local/etc/php/php.ini
COPY ./php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY ./public /var/www/html/