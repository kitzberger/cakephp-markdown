# AGENTS.md — CakePHP Markdown Plugin

A CakePHP 5 plugin providing a `MarkdownHelper` for rendering Markdown in view templates.

## Quick Start

```bash
composer install
vendor/bin/phpunit
vendor/bin/phpcs -p -n --extensions=php --standard=vendor/cakephp/cakephp-codesniffer/CakePHP --ignore=tests/bootstrap.php ./src ./tests
```

## Source Layout

| Path | Purpose |
|---|---|
| `src/View/Helper/MarkdownHelper.php` | Single helper class, namespace `Tanuck\Markdown\View\Helper` |
| `tests/TestCase/View/Helper/MarkdownHelperTest.php` | Single test class, namespace `Tanuck\Markdown\Test\TestCase\View\Helper` |
| `tests/bootstrap.php` | PHPUnit bootstrap that loads CakePHP core bootstrap |

## Key Details

- **PHP**: `>=8.2`, **CakePHP**: `^5.4`, **cebe/markdown**: `^1.2`
- **PSR-4**: `Tanuck\Markdown\` → `src/`, `Tanuck\Markdown\Test\` → `tests/`
- **Runtime dep**: `cebe/markdown` 1.x (supports `Markdown`, `GithubMarkdown`, `MarkdownExtra` parsers)
- **Test bootstrap** (`tests/bootstrap.php`) loads CakePHP core bootstrap (`vendor/cakephp/cakephp/config/bootstrap.php`), uses SQLite in-memory for `test` connection
- **PHPUnit** config is at `phpunit.xml.dist` — run `vendor/bin/phpunit` from project root (no args needed)
- **PHPCS**: CakePHP standard via `cakephp/cakephp-codesniffer`
- **`.editorconfig`**: 4-space indent, LF, trim trailing whitespace, final newline

## Package Identity

`composer.json` name is `kitzberger/cakephp-markdown`. The README plugin handle is `Tanuck/Markdown`. Load with `\App\Application::addPlugin('Tanuck/Markdown')` and use `$this->Markdown->transform($text)` in templates.

## Upgrade Note (CakePHP 4 → 5 migration)

If you find this repo still targeting CakePHP 4 / PHP <8.2 (e.g. old `.travis.yml` testing PHP 5.4-5.6, `tests/bootstrap.php` using `Cache::config()`, `ConnectionManager::config()`, or `Plugin::load()`), the following were required:
- Bump `php` to `>=8.2`, `cakephp/cakephp` to `^5.4`, `cebe/markdown` to `^1.2`, `cakephp/cakephp-codesniffer` to `^5.3`
- Replace `Cache::config()`, `ConnectionManager::config()`, `Log::config()` with `*::setConfig()` counterparts
- Replace `'www_root'` with `'wwwRoot'` in App config
- Add `declare(strict_types=1)` and typed property declarations (dynamic properties error on PHP 8.4)
- Add `: void` return types to `setUp()`/`tearDown()`
