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
    name: 'Java',
    slug: 'java',
    type: LanguageType::Programming,
    extensions: ['.java'],
    aliases: ['java'],
    year: 1995,
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['/*', '*/']],
        docComment: ['/**', '*/'],
        stringDelimiters: ['"', "'"],
        typicalHeaders: ['package ', 'import '],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
