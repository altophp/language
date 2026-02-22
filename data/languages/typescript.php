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

use Alto\Language\BlockStyle;
use Alto\Language\CodeMarkers;
use Alto\Language\IndentStyle;
use Alto\Language\Language;
use Alto\Language\LanguageType;

return new Language(
    name: 'TypeScript',
    slug: 'typescript',
    type: LanguageType::Programming,
    extensions: ['.ts', '.tsx', '.mts', '.cts'],
    aliases: ['typescript', 'ts', 'tsx'],
    year: 2012,
    parent: 'javascript',
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['/*', '*/']],
        docComment: ['/**', '*/'],
        stringDelimiters: ['"', "'", '`'],
        typicalHeaders: ['import ', 'export '],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
