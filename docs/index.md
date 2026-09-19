# Alto Language

Alto Language resolves immutable metadata for 62 programming and document
languages from slugs, aliases, extensions, and exact filenames.

```php
use Alto\Language\Languages;

$language = Languages::fromFilename('src/Example.php');
echo $language?->name;
```

The result is `PHP`. The package returns registered metadata, syntax markers,
and language relationships. It does not inspect source contents or calculate a
detection confidence score.

## Documentation

- [Installation](installation.md)
- [Getting started](getting-started.md)
- [Lookup](lookup.md)
- [Catalog](catalog.md)
- [Definitions](definitions.md)
