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
    name: 'SQL',
    slug: 'sql',
    type: LanguageType::Query,
    extensions: ['.sql'],
    aliases: ['sql', 'mysql', 'postgresql', 'sqlite', 'plsql'],
    year: 1974,
    markers: new CodeMarkers(
        lineComments: ['--'],
        blockComments: [['/*', '*/']],
        stringDelimiters: ["'"],
        typicalHeaders: ['SELECT ', 'CREATE ', 'INSERT ', 'ALTER '],
        blockStyle: BlockStyle::BeginEnd,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
