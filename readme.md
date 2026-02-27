# ToDoアプリケーション

## 技術スタック

- PHP / Laravel
- Blade テンプレート
- Tailwind CSS
- Laravel Breeze（認証）
- MySQL
- Docker / Docker Compose

## 前提条件

- Docker および Docker Compose がインストールされていること

## セットアップ手順

### 1. リポジトリをクローン

```bash
git clone https://github.com/ユーザー名/リポジトリ名.git
cd リポジトリ名
```

### 2. 環境設定ファイルを作成

```bash
cp .env.example .env
```

コピー後、`.env` を開いて以下の項目を自分の環境に合わせて編集する。
DB接続情報は `docker-compose.yml` の設定と一致させること。

```
DB_CONNECTION=mysql
DB_HOST=コンテナのサービス名
DB_PORT=3306
DB_DATABASE=データベース名
DB_USERNAME=ユーザー名
DB_PASSWORD=パスワード
```

### 3. Dockerコンテナを起動

```bash
docker compose up -d
```

### 4. PHPの依存パッケージをインストール

```bash
docker compose exec app composer install
```

> `app` の部分は `docker-compose.yml` で定義しているPHPコンテナのサービス名に置き換えること。

### 5. アプリケーションキーを生成

```bash
docker compose exec app php artisan key:generate
```

### 6. Node.jsの依存パッケージをインストール・ビルド

```bash
docker compose exec app npm install
docker compose exec app npm run build
```

> Node.jsがPHPコンテナに含まれていない場合は、ホスト側で `npm install && npm run build` を実行する。

### 7. マイグレーションを実行

```bash
docker compose exec app php artisan migrate
```

### 8. 動作確認

ブラウザで `http://localhost:ポート番号` にアクセスして動作確認する。
（ポート番号は `docker-compose.yml` の設定に合わせる）

## 注意事項

- `.env` ファイルには機密情報が含まれるため、絶対にGitHubにプッシュしないこと（`.gitignore` に含まれている）
- 開発中は `npm run build` の代わりに `npm run dev` を使うと、ファイル変更時に自動でビルドが走るので便利
- コンテナの停止は `docker compose down`、再起動は `docker compose up -d` で行う
- DB接続情報は `docker-compose.yml` の環境変数と `.env` で整合性を取ること
