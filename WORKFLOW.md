# Git 運用フロー

## ブランチ構成

- **master**: 本番環境用（安定版）
- **dev**: 開発環境用（統合ブランチ）
- **feature/***: 機能開発用ブランチ

## 基本的な運用フロー

### 1. 新機能開発の場合

```bash
# devブランチから最新を取得
git checkout dev
git pull origin dev

# 新しい機能ブランチを作成
git checkout -b feature/新機能名

# 開発・コミット
git add .
git commit -m "機能説明"

# devブランチにマージ
git checkout dev
git merge feature/新機能名

# リモートにプッシュ
git push origin dev
```

### 2. バグ修正の場合

```bash
# devブランチから最新を取得
git checkout dev
git pull origin dev

# バグ修正ブランチを作成
git checkout -b fix/バグ修正内容

# 修正・コミット
git add .
git commit -m "バグ修正: 説明"

# devブランチにマージ
git checkout dev
git merge fix/バグ修正内容

# リモートにプッシュ
git push origin dev
```

### 3. 本番デプロイ時

```bash
# devブランチをmasterにマージ
git checkout master
git pull origin master
git merge dev

# リモートにプッシュ
git push origin master
```

## ブランチ命名規則

- **feature/***: 新機能開発（例: `feature/contact-form`）
- **fix/***: バグ修正（例: `fix/header-menu`）
- **hotfix/***: 緊急修正（例: `hotfix/security-patch`）
- **refactor/***: リファクタリング（例: `refactor/css-structure`）

## 注意事項

1. **必ずdevブランチから新しいブランチを作成**
2. **devブランチにマージする前に動作確認**
3. **コンフリクトが発生した場合は解決してからマージ**
4. **masterブランチは直接編集しない**

## 現在のブランチ状況

- ✅ `concern` → `dev` にマージ済み
- ✅ `doctor-archive` → `dev` にマージ済み
- ✅ `menu-single` → `dev` にマージ済み
- ✅ `privacyPage` → `dev` にマージ済み

これらのブランチは統合済みのため、今後は削除しても問題ありません。

