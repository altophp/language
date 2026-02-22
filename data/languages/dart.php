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
    name: 'Dart',
    slug: 'dart',
    type: LanguageType::Programming,
    extensions: ['.dart'],
    aliases: ['dart'],
    year: 2011,
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['/*', '*/']],
        docComment: ['///', '///'],
        stringDelimiters: ['"', "'"],
        typicalHeaders: ['import ', 'void main('],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
