FROM mysql:5.7

COPY ./mysql/my.cnf /etc/mysql/conf.d/
# localesパッケージ（言語設定）のインストール
RUN apt-get update && apt-get install -y \
  locales \
  # パッケージをインストールするために拾ってきたアーカイブファイル削除（.tar.zip等）
  && apt-get clean \
  # aptキャッシュをクリーンし、/var/lib/apt/lits を削除することで、イメージのサイズを減らす
  && rm -rf /var/lib/apt/lists/*
# 日本語設定
RUN sed -i -E 's/# (ja_JP.UTF-8)/\1/' /etc/locale.gen \
  && locale-gen
ENV LANG ja_JP.UTF-8
# [コンテナ起動時に実行するコマンド、引数、一数]
# mysqld は [mysqld] および [server] グループ（my.cnfに記載）からオプションを読み取ります。
CMD ["mysqld", "--character-set-server=utf8", "--collation-server=utf8_unicode_ci"]