# Installation

Alto Language requires PHP 8.4 or later and has no runtime dependencies.

```bash
composer require alto/language
```

## Verify the installation

```php
<?php

require __DIR__.'/vendor/autoload.php';

use Alto\Language\Languages;

echo Languages::fromExtension('.php')?->name;
```

The script prints `PHP`.
