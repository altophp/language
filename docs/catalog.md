# Language catalog

The bundled registry contains 62 language definitions. Use the catalog for
selection and discovery; use [Lookup](lookup.md) when an identifier is already
known.

```php
use Alto\Language\LanguageType;
use Alto\Language\Languages;

$all = Languages::all();
$templates = Languages::ofType(LanguageType::Template);
$javascriptFamily = Languages::children('javascript');
```

`all()` preserves definition loading order. `ofType()` and `children()` return
filtered lists of `Language` objects.

| Language | Extensions | Type |
| --- | --- | --- |
| Bash | `.sh`, `.bash` | Programming |
| C | `.c`, `.h` | Programming |
| C# | `.cs` | Programming |
| C++ | `.cpp`, `.cc`, `.cxx`, `.hpp` | Programming |
| Clojure | `.clj`, `.cljs`, `.cljc` | Programming |
| CMake | `.cmake` | Programming |
| CoffeeScript | `.coffee` | Programming |
| CSS | `.css` | Stylesheet |
| Dart | `.dart` | Programming |
| Diff | `.diff`, `.patch` | Data |
| Dockerfile | Exact filenames | Config |
| Dotenv | Exact filenames | Config |
| Elixir | `.ex`, `.exs` | Programming |
| Erlang | `.erl`, `.hrl` | Programming |
| F# | `.fs`, `.fsi`, `.fsx` | Programming |
| Git Attributes | Exact filenames | Config |
| Git Config | Exact filenames | Config |
| Go | `.go` | Programming |
| GraphQL | `.graphql`, `.gql` | Query |
| Groovy | `.groovy`, `.gvy` | Programming |
| Haskell | `.hs`, `.lhs` | Programming |
| HCL | `.hcl`, `.tf` | Programming |
| htaccess | Exact filenames | Config |
| HTML | `.html`, `.htm` | Markup |
| HTTP | `.http`, `.rest` | Data |
| Ignore | Exact filenames | Config |
| INI | `.ini`, `.cfg` | Config |
| Java | `.java` | Programming |
| JavaScript | `.js`, `.mjs`, `.cjs`, `.jsx` | Programming |
| JSON | `.json` | Data |
| Julia | `.jl` | Programming |
| Just | Exact filenames | Config |
| Kotlin | `.kt`, `.kts` | Programming |
| Less | `.less` | Stylesheet |
| Lua | `.lua` | Programming |
| Makefile | Exact filenames | Programming |
| Markdown | `.md`, `.markdown` | Prose |
| NEON | `.neon` | Config |
| Nix | `.nix` | Programming |
| Objective-C | `.m`, `.mm` | Programming |
| OCaml | `.ml`, `.mli` | Programming |
| Perl | `.pl`, `.pm` | Programming |
| PHP | `.php`, `.phtml`, `.php3`, `.php4`, `.php5`, `.phps` | Programming |
| PowerShell | `.ps1`, `.psm1` | Programming |
| Procfile | Exact filenames | Config |
| Protocol Buffers | `.proto` | Data |
| Python | `.py`, `.pyw` | Programming |
| R | `.r`, `.R` | Programming |
| Ruby | `.rb` | Programming |
| Rust | `.rs` | Programming |
| Sass | `.sass` | Stylesheet |
| Scala | `.scala`, `.sc` | Programming |
| SCSS | `.scss` | Stylesheet |
| SQL | `.sql` | Query |
| SVG | `.svg` | Markup |
| Swift | `.swift` | Programming |
| TOML | `.toml` | Config |
| Twig | `.twig` | Template |
| TypeScript | `.ts`, `.tsx`, `.mts`, `.cts` | Programming |
| XML | `.xml`, `.xsl`, `.xsd` | Markup |
| YAML | `.yml`, `.yaml` | Data |
| Zig | `.zig` | Programming |

Types are represented by `LanguageType`: `Programming`, `Markup`, `Data`,
`Prose`, `Query`, `Stylesheet`, `Template`, `Config`, and `Other`.
