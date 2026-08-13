# ALTO Language

Programming and document language metadata for PHP applications.

&nbsp; ![PHP Version](https://img.shields.io/badge/PHP-8.4%2B-00B7FF?logoColor=00B7FF&labelColor=050608)
&nbsp; ![CI](https://img.shields.io/github/actions/workflow/status/altophp/language/CI.yml?branch=main&label=Tests&labelColor=050608&color=00B7FF)
&nbsp; [![Packagist](https://img.shields.io/packagist/v/alto/language?label=Packagist&labelColor=050608&color=00B7FF)](https://packagist.org/packages/alto/language)
&nbsp; ![License](https://img.shields.io/github/license/altophp/language?label=License&labelColor=050608&color=00B7FF)
&nbsp; [![GitHub Sponsors](https://img.shields.io/github/sponsors/smnandre?logo=githubsponsors&logoColor=00B7FF&label=%20Sponsor&labelColor=050608&color=00B7FF)](https://github.com/sponsors/smnandre)

ALTO Language resolves programming and document languages from slugs, aliases, extensions, and
exact filenames. It returns immutable metadata with syntax markers, relationships, and common
formatting conventions without inspecting file contents.

```php
use Alto\Language\Languages;

$language = Languages::fromFilename('templates/home.html.twig');

echo $language?->name;        // Twig
echo $language?->type->value; // template
```

The package includes 62 lazily loaded definitions and has no runtime dependencies. Catalog tests
check every slug, extension, alias, filename, and parent relationship for consistency.

## Installation

Install ALTO Language with Composer:

```bash
composer require alto/language
```

ALTO Language requires PHP 8.4 or later. It does not require additional PHP extensions.

## Quick Start

Use the `Languages` facade when the identifier type is known:

```php
use Alto\Language\Languages;

$php = Languages::get('php');
$rust = Languages::fromExtension('rs');
$python = Languages::fromAlias('py');
$make = Languages::fromFilename('/project/Makefile');
```

Each lookup returns a `Language` value object or `null`. Use `Languages::resolve()` only when the
identifier may be a slug, alias, extension, or filename.

## Documentation

The [ALTO Language documentation](https://altophp.com/language/) covers:

- [lookup rules](https://altophp.com/language/lookup/);
- the [bundled catalog](https://altophp.com/language/catalog/);
- [language definitions and custom registration](https://altophp.com/language/definitions/).

## Contributing

Contributions of all kinds are welcome. Visit the
[project on GitHub](https://github.com/altophp/language) to
[report a bug](https://github.com/altophp/language/issues/new),
[suggest a feature](https://github.com/altophp/language/issues/new), or
[open a pull request](https://github.com/altophp/language/pulls).

Before submitting code, run:

```bash
# Runs PHP CS Fixer, PHPStan, and PHPUnit
composer qa
```

Changes to public behavior should include tests and documentation.

Bundled definitions live in `data/languages/`. Add one file named after the language slug; the
catalog consistency tests validate its identifiers, filenames, and parent relationship.

## Support

ALTO Language is open source. You can support its continued development through
[GitHub Sponsors](https://github.com/sponsors/smnandre).

Sharing this package with others or
[starring it on GitHub](https://github.com/altophp/language) is also much
appreciated.

## License

ALTO Language is released by [ALTO PHP](https://altophp.com) under the
[MIT License](LICENSE).
