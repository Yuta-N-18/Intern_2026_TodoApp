# ToDoアプリケーション

## 技術スタック

- PHP / Laravel
- Blade テンプレート
- Tailwind CSS
- Laravel Breeze（認証）
- MySQL
- Docker / Docker Compose

## ディレクトリ構成

```
.
├── docker-compose.yml        # Docker Compose 設定ファイル（app / nginx / db の3サービス）
├── readme.md                 # プロジェクトの説明ドキュメント
├── __learning/               # PHP 学習用ファイル置き場
│   ├── docker-compose-yml.txt
│   ├── test.php
│   └── work1.php
├── web/                      # Nginx 設定
│   └── default.conf          # Nginx のバーチャルホスト設定（リバースプロキシ含む）
└── example-app/              # Laravel アプリケーション本体
    ├── Dockerfile            # PHP-FPM コンテナのビルド定義
    ├── artisan               # Laravel CLI エントリポイント
    ├── composer.json          # PHP 依存パッケージ定義
    ├── package.json           # Node.js 依存パッケージ定義
    ├── vite.config.js         # Vite（フロントエンドビルドツール）設定
    ├── tailwind.config.js     # Tailwind CSS 設定
    ├── phpunit.xml            # テスト設定
    ├── app/                   # アプリケーションコア
    │   ├── Http/
    │   │   ├── Controllers/   # コントローラー（TaskController 等）
    │   │   └── Requests/      # フォームリクエスト（バリデーション）
    │   ├── Models/            # Eloquent モデル（Task, User）
    │   ├── Providers/         # サービスプロバイダー
    │   └── View/              # ビューコンポーネント関連
    ├── bootstrap/             # フレームワーク起動処理
    ├── config/                # 各種設定ファイル（DB, 認証, キャッシュ等）
    ├── database/
    │   ├── factories/         # モデルファクトリー（テストデータ生成）
    │   ├── migrations/        # DBマイグレーション（テーブル定義）
    │   └── seeders/           # シーダー（初期データ投入）
    ├── public/                # 公開ディレクトリ（Webサーバーのドキュメントルート）
    ├── resources/
    │   ├── css/               # CSS ソースファイル
    │   ├── js/                # JavaScript ソースファイル
    │   └── views/             # Blade テンプレート（画面表示）
    ├── routes/
    │   ├── web.php            # Webルーティング定義
    │   ├── auth.php           # 認証関連ルーティング
    │   └── console.php        # Artisan コマンド定義
    ├── storage/               # ログ・キャッシュ・アップロードファイル等
    └── tests/                 # テストコード
        ├── Feature/           # 機能テスト
        └── Unit/              # ユニットテスト
```

### 各ディレクトリの役割

| ディレクトリ / ファイル | 説明 |
|---|---|
| `docker-compose.yml` | `app`（PHP-FPM）、`nginx`（Webサーバー）、`db`（MySQL 8）の3つのサービスを定義 |
| `__learning/` | PHP の学習・練習用スクリプトを格納するディレクトリ（アプリ本体とは独立） |
| `web/` | Nginx の設定ファイルを格納。ポート80でLaravelへ、ポート5173でVite開発サーバーへプロキシ |
| `example-app/` | Laravel プロジェクトのルートディレクトリ。ToDo アプリの全ソースコードが含まれる |
| `example-app/app/` | MVC の Model・Controller やサービスプロバイダーなどのアプリケーションロジック |
| `example-app/resources/views/` | Blade テンプレート。タスクの一覧・作成・編集画面などのUI |
| `example-app/routes/` | URL とコントローラーの対応を定義するルーティングファイル |
| `example-app/database/migrations/` | テーブル作成・変更のマイグレーションファイル |
| `example-app/tests/` | PHPUnit / Pest によるテストコード |

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
