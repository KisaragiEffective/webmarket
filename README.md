# WebMarket
仮想市場をあなたのWebブラウザから！

# 動作環境
* `PHP` >= 7
* `Laravel` ~> 6

# 注釈
- vendorディレクトリは入っていません。`composer install`で作成してください。
- `.env`はレポジトリに入っていません。
- minecraft.jpのOAuthに必要なAPIキーは入っていません。[minecraft.jp](https://minecraft.jp/developer/apps/new)から取得してください。
- `.env`に以下を追記してください。
```
# ここはAPIキーを入れる
JMS_CLIENT_ID=xxxxx
JMS_CLIENT_SECRET=xxxxx
JMS_CALLBACK=https://your.domain.com/login/minecraft.jp/callback
```

# ブラウザ動作環境
- **IEには対応しません。** EdgeやFirefox、Chromeといった「モダン」ブラウザをお使いください。
