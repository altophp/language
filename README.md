# Alto Code Language

A lightweight PHP library providing structured metadata for **62 programming languages** — extensions, aliases,
filenames, syntax markers, and more.

Zero dependencies. 100% test coverage. PHP 8.4+.

## Installation

```bash
composer require alto/code-language
```

## Quick Start

```php
use Alto\Code\Language\Languages;

// Lookup by slug
$php = Languages::get('php');
$php->name;       // "PHP"
$php->extensions; // [".php", ".phtml", ".php3", …]
$php->type;       // LanguageType::Programming

// Lookup by file extension
Languages::fromExtension('.ts');       // → typescript
Languages::fromExtension('rs');        // → rust (dot is optional)

// Lookup by alias
Languages::fromAlias('py');            // → python
Languages::fromAlias('jsx');           // → javascript

// Lookup by filename
Languages::fromFilename('Dockerfile'); // → dockerfile
Languages::fromFilename('Makefile');   // → makefile
Languages::fromFilename('.gitignore'); // → ignore

// Compound extension fallback
Languages::fromFilename('phpunit.xml.dist'); // → xml

// Resolve from any identifier (slug → alias → extension → filename)
Languages::resolve('typescript');      // by slug
Languages::resolve('ts');             // by alias
Languages::resolve('.tsx');           // by extension
Languages::resolve('Makefile');       // by filename
```

## API

### Static Facade (`Languages`)

| Method                            | Returns      | Description                              |
|-----------------------------------|--------------|------------------------------------------|
| `Languages::get($slug)`           | `?Language`  | Lookup by slug                           |
| `Languages::fromExtension($ext)`  | `?Language`  | Lookup by file extension                 |
| `Languages::fromAlias($alias)`    | `?Language`  | Lookup by alias                          |
| `Languages::fromFilename($name)`  | `?Language`  | Lookup by exact filename or extension    |
| `Languages::resolve($identifier)` | `?Language`  | Try all lookup methods in order          |
| `Languages::all()`                | `Language[]` | All registered languages                 |
| `Languages::ofType($type)`        | `Language[]` | Filter by `LanguageType`                 |
| `Languages::children($slug)`      | `Language[]` | Languages whose parent is the given slug |
| `Languages::conflicts()`          | `array`      | Extension/alias/filename collisions      |

### Injectable Registry (`LanguageRegistry`)

All facade methods delegate to `LanguageRegistry`, which can be injected directly:

```php
use Alto\Code\Language\LanguageRegistry;

$registry = new LanguageRegistry();
$python = $registry->get('python');
```

### Language Object

Each `Language` is an immutable value object:

```php
$lang = Languages::get('typescript');

$lang->name;       // "TypeScript"
$lang->slug;       // "typescript"
$lang->type;       // LanguageType::Programming
$lang->extensions; // [".ts", ".tsx", ".mts", ".cts"]
$lang->aliases;    // ["ts"]
$lang->filenames;  // []
$lang->year;       // 2012
$lang->parent;     // "javascript"
$lang->markers;    // CodeMarkers instance
```

Languages are JSON-serializable:

```php
json_encode(Languages::get('go'));
```

### Code Markers

Syntax fingerprints attached to each language:

```php
$markers = Languages::get('php')->markers;

$markers->lineComments;     // ["//", "#"]
$markers->blockComments;    // [["/*", "*/"]]
$markers->docComment;       // ["/**", "*/"]
$markers->stringDelimiters; // ["\"", "'"]
$markers->heredoc;          // true
$markers->shebang;          // "#!/usr/bin/env php"
$markers->openingTag;       // "<?php"
$markers->typicalHeaders;   // ["<?php", "<?="]
$markers->blockStyle;       // BlockStyle::Braces
$markers->defaultIndentation; // 4
$markers->indentStyle;      // IndentStyle::Spaces
```

### Enums

**`LanguageType`** — categorizes languages by purpose:

`Programming`, `Markup`, `Data`, `Prose`, `Query`, `Stylesheet`, `Template`, `Config`, `Other`

**`BlockStyle`** — code block delimiters:

`Braces`, `Indentation`, `BeginEnd`, `Tags`, `None`

**`IndentStyle`** — default indentation:

`Spaces`, `Tabs`

## Languages

62 languages included:

| Language         | Extensions                    | Type        |
|------------------|-------------------------------|-------------|
| Bash             | `.sh`, `.bash`                | Programming |
| C                | `.c`, `.h`                    | Programming |
| C#               | `.cs`                         | Programming |
| C++              | `.cpp`, `.cc`, `.cxx`, `.hpp` | Programming |
| Clojure          | `.clj`, `.cljs`, `.cljc`      | Programming |
| CMake            | `.cmake`                      | Programming |
| CoffeeScript     | `.coffee`                     | Programming |
| CSS              | `.css`                        | Stylesheet  |
| Dart             | `.dart`                       | Programming |
| Diff             | `.diff`, `.patch`             | Data        |
| Dockerfile       | —                             | Config      |
| Dotenv           | —                             | Config      |
| Elixir           | `.ex`, `.exs`                 | Programming |
| Erlang           | `.erl`, `.hrl`                | Programming |
| F#               | `.fs`, `.fsi`, `.fsx`         | Programming |
| Git Attributes   | —                             | Config      |
| Git Config       | —                             | Config      |
| Go               | `.go`                         | Programming |
| GraphQL          | `.graphql`, `.gql`            | Query       |
| Groovy           | `.groovy`, `.gvy`             | Programming |
| Haskell          | `.hs`, `.lhs`                 | Programming |
| HCL              | `.hcl`, `.tf`                 | Programming |
| htaccess         | —                             | Config      |
| HTML             | `.html`, `.htm`               | Markup      |
| HTTP             | `.http`, `.rest`              | Data        |
| Ignore           | —                             | Config      |
| INI              | `.ini`, `.cfg`                | Config      |
| Java             | `.java`                       | Programming |
| JavaScript       | `.js`, `.mjs`, `.cjs`, `.jsx` | Programming |
| JSON             | `.json`                       | Data        |
| Julia            | `.jl`                         | Programming |
| Just             | —                             | Config      |
| Kotlin           | `.kt`, `.kts`                 | Programming |
| Less             | `.less`                       | Stylesheet  |
| Lua              | `.lua`                        | Programming |
| Makefile         | —                             | Programming |
| Markdown         | `.md`, `.markdown`            | Prose       |
| NEON             | `.neon`                       | Config      |
| Nix              | `.nix`                        | Programming |
| Objective-C      | `.m`, `.mm`                   | Programming |
| OCaml            | `.ml`, `.mli`                 | Programming |
| Perl             | `.pl`, `.pm`                  | Programming |
| PHP              | `.php`, `.phtml`              | Programming |
| PowerShell       | `.ps1`, `.psm1`               | Programming |
| Procfile         | —                             | Config      |
| Protocol Buffers | `.proto`                      | Data        |
| Python           | `.py`, `.pyw`                 | Programming |
| R                | `.r`, `.R`                    | Programming |
| Ruby             | `.rb`                         | Programming |
| Rust             | `.rs`                         | Programming |
| Sass             | `.sass`                       | Stylesheet  |
| Scala            | `.scala`, `.sc`               | Programming |
| SCSS             | `.scss`                       | Stylesheet  |
| SQL              | `.sql`                        | Query       |
| SVG              | `.svg`                        | Markup      |
| Swift            | `.swift`                      | Programming |
| TOML             | `.toml`                       | Config      |
| Twig             | `.twig`                       | Template    |
| TypeScript       | `.ts`, `.tsx`, `.mts`, `.cts` | Programming |
| XML              | `.xml`, `.xsl`, `.xsd`        | Markup      |
| YAML             | `.yml`, `.yaml`               | Data        |
| Zig              | `.zig`                        | Programming |

Languages with filename-based matching (no extension): Dockerfile, Makefile, `.gitignore`, `.env`, `Procfile`,
`Justfile`, `.htaccess`, and more.

## Contributing

Contributions are welcome! Please feel free to [submit issues](https://github.com/phpalto/code-language/issues)
or [pull requests](https://github.com/phpalto/code-language/pulls).

### Adding a Language

Create a new file in `data/languages/`:

```php
<?php
// data/languages/mylang.php

use Alto\Code\Language\CodeMarkers;
use Alto\Code\Language\Language;
use Alto\Code\Language\LanguageType;

return new Language(
    name: 'MyLang',
    slug: 'mylang',
    type: LanguageType::Programming,
    extensions: ['.ml'],
    aliases: ['my'],
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['/*', '*/']],
    ),
);
```

## License

Released by the [Alto project](https://github.com/phpalto) under the MIT License.
See the [LICENSE](LICENSE) file for details.
