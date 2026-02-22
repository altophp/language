<?php

declare(strict_types=1);

/*
 * This file is part of the ALTO library.
 *
 * © 2026–present Simon André
 *
 * For full copyright and license information, please see
 * the LICENSE file distributed with this source code.
 */

use Alto\Code\Language\BlockStyle;
use Alto\Code\Language\CodeMarkers;
use Alto\Code\Language\IndentStyle;
use Alto\Code\Language\Language;
use Alto\Code\Language\LanguageType;

return new Language(
    name: 'Python',
    slug: 'python',
    type: LanguageType::Programming,
    extensions: ['.py', '.pyi', '.pyw'],
    aliases: ['python', 'py', 'python3'],
    year: 1991,
    markers: new CodeMarkers(
        lineComments: ['#'],
        blockComments: [['"""', '"""'], ["'''", "'''"]],
        stringDelimiters: ['"', "'", '"""', "'''"],
        shebang: '#!/usr/bin/env python3',
        typicalHeaders: ['#!/usr/bin/env python', 'import ', 'from '],
        blockStyle: BlockStyle::Indentation,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
