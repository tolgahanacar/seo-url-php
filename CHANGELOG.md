# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

---

## [2.0.0] - 2026-07-06

This is a major release featuring full modernization for modern PHP versions (up to PHP 8.5+), secure configuration design patterns, bug corrections, and a premium visual redesign.

### Added
- **GitHub Actions CI:** Introduced `.github/workflows/ci.yml` pipeline supporting automatic PHP linting checks from PHP 8.0 up to PHP 8.5. Improved error propagation by shifting from xargs to strict find-exec.
- **Modern Styling:** Built responsive, premium glassmorphism layouts with modern custom CSS variables and styling on both `index.php` and `post.php`.
- **Strict Typing:** Implemented PHP `declare(strict_types=1)` declarations across all project files.
- **Type Constraints:** Added explicit parameter types (`string $text`) and return types (`: string`) to helper functions.
- **Configuration Layer:** Added `utility/config.php` for isolated local environment configurations (added to `.gitignore` to prevent secret leaks). Added `utility/config.php.example` as a template for developers and testing pipelines.

### Fixed
- **SEO Slug Generation Bug:** Corrected the order of operations in `seolink()`. Accented and Turkish characters are now correctly replaced with Latin equivalents *before* non-alphanumeric characters are stripped.
- **Environment Compatibility:** Resolved reliance on the `mbstring` extension by mapping both upper and lowercase Turkish characters directly to lowercase English, preventing fatal crashes on minimal PHP runtimes.
- **Direct Access & Redirect Bugs:** Fixed page routing bugs in `post.php` by determining redirect targets dynamically, resolving context-aware relative paths (e.g. direct calls vs mod_rewrite calls).
- **Syntax Warnings:** Removed stray closing PHP tags (`?>`) at the end of files which caused random tag rendering on HTML layouts.

### Changed
- **Database Connection Security:** Modified `utility/connect.php` to log detailed PDO exception traces internally via `error_log()` instead of echoing them to front-end page layouts.
- **Unicode Support:** Upgraded database DSN connection charset from legacy `utf8` to modern `utf8mb4`.
- **Database SQL Script:** Cleaned up `import/posts.sql` by removing phpMyAdmin metadata, adding automated database creation commands, upgrading table encoding to `utf8mb4`, and inserting a third post specifically for Turkish character testing.

---

## [1.0.0] - 2021-05-29

### Added
- Initial setup of the repository.
- Basic database integration using PDO.
- Basic SEO link generation function for Turkish character mapping.
- `.htaccess` mod_rewrite rules mapping `post/{sef}-{id}` to `post.php`.
- MySQL database schema file `posts.sql`.
