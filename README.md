# WebMarket
![Laravel test](https://github.com/kisaragieffective/webmarket/workflows/Laravel/badge.svg?branch=develop)

仮想市場をあなたのWebブラウザから！

## 動作環境
* `PHP` >= 7
* `Laravel` ~> 6
* `MariaDB`

## 環境構築
1. 以下のコマンドを実行します。
```shell script
./setup.sh
```

2. [minecraft.jp](https://minecraft.jp/developer/apps/new) でminecraft.jpで連携ログインするために必要なAPIキーを取得します。
3. `.env` ファイルを以下のように書き換えます。
```
# ここはAPIキーを入れる
JMS_CLIENT_ID=1111222233334444
JMS_CLIENT_SECRET=aaabbbccccddddd
```

## 注釈
- minecraft.jpのOAuthに必要なAPIキーは入っていません。[minecraft.jp](https://minecraft.jp/developer/apps/new) から取得してください。



## ブラウザ動作環境
- **IEには対応しません。** EdgeやFirefox、Chromeといった「モダン」ブラウザをお使いください。

## ライセンス
MIT
