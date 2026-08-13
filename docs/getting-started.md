# Getting started

Use `Languages::fromFilename()` when an application has a path and wants the
best matching bundled definition.

```php
use Alto\Language\Languages;

$language = Languages::fromFilename('templates/home.html.twig');

if (null === $language) {
    throw new RuntimeException('Unknown language.');
}

echo $language->name;
echo $language->type->value;
```

Exact filenames such as `Dockerfile` and `.gitignore` are checked first.
Otherwise, the registry tests extensions from right to left. A compound name
therefore falls back until a registered suffix matches.

## Inspect the result

```php
$language->slug;
$language->extensions;
$language->aliases;
$language->filenames;
$language->year;
$language->parent;
$language->markers;
```

`Language` and `CodeMarkers` are immutable and JSON-serializable:

```php
$json = json_encode($language, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
```

See [Lookup](lookup.md) for other identifiers and [Definitions](definitions.md)
for every available field.
