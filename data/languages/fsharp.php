<?php

declare(strict_types=1);

/*
 * This file is part of the ALTO library.
 *
 * © 2026-present Simon André
 *
 * For full copyright and license information, please see
 * the LICENSE file distributed with this source code.
 */

use Alto\Language\BlockStyle;
use Alto\Language\CodeMarkers;
use Alto\Language\IndentStyle;
use Alto\Language\Language;
use Alto\Language\LanguageType;

return new Language(
    name: 'F#',
    slug: 'fsharp',
    type: LanguageType::Programming,
    extensions: ['.fs', '.fsx', '.fsi'],
    aliases: ['fsharp', 'f#', 'fs'],
    year: 2005,
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['(*', '*)']],
        docComment: ['///', '///'],
        stringDelimiters: ['"'],
        typicalHeaders: ['open ', 'module ', 'namespace '],
        blockStyle: BlockStyle::Indentation,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
