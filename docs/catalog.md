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

| Language | Extensions | Exact filenames | Type |
| --- | --- | --- | --- |
| Bash | `.sh`, `.bash`, `.zsh` | `.bashrc`, `.bash_profile`, `.bash_logout`, `.profile` | Programming |
| C | `.c`, `.h` | - | Programming |
| Clojure | `.clj`, `.cljs`, `.cljc`, `.edn` | - | Programming |
| CMake | `.cmake` | `CMakeLists.txt` | Config |
| CoffeeScript | `.coffee`, `.litcoffee` | - | Programming |
| C++ | `.cpp`, `.cc`, `.cxx`, `.hpp`, `.hh`, `.hxx` | - | Programming |
| C# | `.cs`, `.csx` | - | Programming |
| CSS | `.css` | - | Stylesheet |
| Dart | `.dart` | - | Programming |
| Diff | `.diff`, `.patch` | - | Other |
| Dockerfile | `.dockerfile` | `Dockerfile`, `Dockerfile.dev`, `Dockerfile.prod` | Config |
| DotEnv | `.env` | `.env`, `.env.local`, `.env.production`, `.env.development` | Config |
| Elixir | `.ex`, `.exs` | - | Programming |
| Erlang | `.erl`, `.hrl` | - | Programming |
| F# | `.fs`, `.fsx`, `.fsi` | - | Programming |
| Git Attributes | - | `.gitattributes` | Config |
| Git Config | `.gitconfig` | `.gitconfig`, `.gitmodules`, `.mailmap` | Config |
| Go | `.go` | - | Programming |
| GraphQL | `.graphql`, `.gql` | - | Query |
| Groovy | `.groovy`, `.gvy`, `.gy`, `.gsh` | - | Programming |
| Haskell | `.hs`, `.lhs` | - | Programming |
| HCL | `.hcl`, `.tf`, `.tfvars` | - | Config |
| Apache Config | - | `.htaccess`, `.htpasswd` | Config |
| HTML | `.html`, `.htm`, `.xhtml` | - | Markup |
| HTTP | `.http` | - | Other |
| Ignore List | - | `.gitignore`, `.dockerignore`, `.npmignore`, `.eslintignore`, `.prettierignore`, `.stylelintignore`, `.hgignore`, `.nowignore`, `.vercelignore`, `.gcloudignore` | Config |
| INI | `.ini`, `.cfg`, `.properties` | `.editorconfig`, `.npmrc` | Config |
| Java | `.java` | - | Programming |
| JavaScript | `.js`, `.mjs`, `.cjs`, `.jsx` | - | Programming |
| JSON | `.json`, `.jsonc`, `.geojson`, `.json5` | `.prettierrc`, `.eslintrc`, `.babelrc`, `.swcrc`, `composer.lock` | Data |
| Julia | `.jl` | - | Programming |
| Just | - | `Justfile`, `justfile` | Config |
| Kotlin | `.kt`, `.kts` | - | Programming |
| Less | `.less` | - | Stylesheet |
| Lua | `.lua` | - | Programming |
| Makefile | `.mk` | `Makefile`, `GNUmakefile`, `makefile` | Config |
| Markdown | `.md`, `.markdown`, `.mdx` | - | Prose |
| NEON | `.neon` | - | Config |
| Nix | `.nix` | - | Config |
| Objective-C | `.m`, `.mm` | - | Programming |
| OCaml | `.ml`, `.mli` | - | Programming |
| Perl | `.pl`, `.pm`, `.t` | - | Programming |
| PHP | `.php`, `.phtml`, `.php3`, `.php4`, `.php5`, `.phps` | - | Programming |
| PowerShell | `.ps1`, `.psm1`, `.psd1` | - | Programming |
| Procfile | - | `Procfile` | Config |
| Protocol Buffers | `.proto` | - | Data |
| Python | `.py`, `.pyi`, `.pyw` | - | Programming |
| R | `.r`, `.R`, `.rmd` | - | Programming |
| Ruby | `.rb`, `.rake`, `.gemspec` | `Gemfile`, `Rakefile`, `Guardfile`, `Vagrantfile`, `Podfile`, `Capfile`, `Brewfile`, `Berksfile` | Programming |
| Rust | `.rs` | - | Programming |
| Sass | `.sass` | - | Stylesheet |
| Scala | `.scala`, `.sc` | - | Programming |
| SCSS | `.scss` | - | Stylesheet |
| SQL | `.sql` | - | Query |
| SVG | `.svg` | - | Markup |
| Swift | `.swift` | - | Programming |
| TOML | `.toml` | - | Data |
| Twig | `.twig`, `.html.twig` | - | Template |
| TypeScript | `.ts`, `.tsx`, `.mts`, `.cts` | - | Programming |
| XML | `.xml`, `.xsd`, `.xsl`, `.xslt`, `.wsdl` | - | Markup |
| YAML | `.yml`, `.yaml` | - | Data |
| Zig | `.zig` | - | Programming |

Types are represented by `LanguageType`: `Programming`, `Markup`, `Data`,
`Prose`, `Query`, `Stylesheet`, `Template`, `Config`, and `Other`.
