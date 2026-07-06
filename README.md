# SEO URL - PHP Modern Showcase

[![CI](https://github.com/tolgahanacar/seo-url-php/actions/workflows/ci.yml/badge.svg)](https://github.com/tolgahanacar/seo-url-php/actions/workflows/ci.yml)
[![PHP Version](https://img.shields.io/badge/PHP-8.0--8.5-blue.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

A robust, modernized, and secure demonstration of creating search-engine-optimized (SEO) friendly URL routing in PHP. This project provides a complete implementation of mapping dynamically generated content to static, human-readable URLs using Apache's `.htaccess` mod_rewrite and MySQL.

Now fully updated, secure, type-safe, and compatible with **PHP 8.0 through PHP 8.5+**.

---

## ✨ Features

- **Dynamic to Static URL Mapping:** Automatically rewrite paths like `post.php?id=1` to clean, human-readable URLs like `/post/lorem-ipsum-1`.
- **Accented & Turkish Character Mapping:** A robust slug generation helper translating special characters (e.g., `Ğ, Ü, Ş, İ, Ö, Ç`) to safe Latin characters (`g, u, s, i, o, c`) before stripping non-alphanumeric elements.
- **PHP 8.5+ Standard:** Strictly typed codebase (`declare(strict_types=1)`), with explicit parameter and return type declarations.
- **Modern Responsive Design:** A gorgeous, glassmorphic dark-theme UI with responsive layouts, hover card animations, and Google Inter typography.
- **Security-First Practices:**
  - Database queries use secure PDO prepared statements to block SQL Injections.
  - Context-aware XSS prevention via `htmlspecialchars()` escaping.
  - Separated configuration parameters to avoid version control secret leaks.
  - Generic client-side database error messages coupled with detailed internal logging (`error_log`).
- **Environment Resiliency:** Avoids external dependencies (like `mbstring`) by mapping characters efficiently, enabling successful deployment on default minimal PHP runtimes.
- **Automated CI/CD:** GitHub Actions workflow ensuring PHP syntax validation across a matrix of PHP versions (8.0, 8.1, 8.2, 8.3, 8.4, and 8.5).

---

## 📂 Project Structure

```text
seo-url-php/
├── .github/
│   └── workflows/
│       └── ci.yml          # GitHub Actions CI Workflow
├── import/
│   └── posts.sql           # Database schema & initial data import
├── utility/
│   ├── config.php          # Database configuration (gitignore'd)
│   ├── connect.php         # PDO connection script
│   └── functions.php       # SEO slug generation & helpers
├── .gitignore              # Ignored local config files
├── .htaccess               # Apache URL rewrite configurations
├── CHANGELOG.md            # Project release log
├── README.md               # Documentation
├── index.php               # Homepage / Post feed
└── post.php                # Detailed post viewer
```

---

## ⚙️ Requirements

- **PHP:** `8.0` or higher (fully compatible with PHP `8.5`)
- **Web Server:** Apache with `mod_rewrite` enabled
- **Database:** MySQL / MariaDB

---

## 🚀 Installation & Setup

Follow these steps to run the project locally:

### 1. Clone the Repository
```bash
git clone https://github.com/tolgahanacar/seo-url-php.git
cd seo-url-php
```

### 2. Set Up the Database
Import the SQL script located in the `import/` directory to create the `seourl` database and `posts` table:
```bash
# Log in to MySQL and run:
mysql -u root -p < import/posts.sql
```

### 3. Configure Database Credentials
Create a local configuration file at `utility/config.php` (this file is excluded from Git to protect secrets):
```php
<?php
declare(strict_types=1);

return [
    'host' => 'localhost',
    'dbname' => 'seourl',
    'charset' => 'utf8mb4',
    'username' => 'your_db_username',
    'password' => 'your_db_password',
];
```

### 4. Enable Apache Mod Rewrite
Ensure Apache configuration permits override rules in `.htaccess`. Your virtual host block or server configuration directory should look like this:
```apache
<Directory "/path/to/seo-url-php">
    AllowOverride All
    Require all granted
</Directory>
```

### 5. Start the Server
Navigate to the directory in your browser, or start a local development server:
```bash
# Using PHP built-in server (Note: URL rewrites from .htaccess won't run on PHP built-in server out-of-the-box)
php -S localhost:8000
```
*Note: To test `.htaccess` rewrite rules (e.g. `/post/slug-1`), serve the project using an actual Apache server instance.*

---

## 📝 Usage & Slug Example

URL slugs are generated via the `seolink(string $text): string` function:

```php
require_once 'utility/functions.php';

echo seolink("Türkçe başlık - Ünlü Şarkıcı!");
// Output: "turkce-baslik-unlu-sarkici"
```

The corresponding HTML routing is dynamically constructed:
```html
<a href="post/<?= seolink($post->postname) . '-' . $post->id ?>">More</a>
```
Apache translates the request `/post/turkce-baslik-unlu-sarkici-1` and forwards it to `post.php?sef=turkce-baslik-unlu-sarkici&id=1` internally.

---

## 📈 Changelog

See [CHANGELOG.md](CHANGELOG.md) for detailed descriptions of releases and changes.

---

## 📄 License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
