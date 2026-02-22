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
    name: 'Rust',
    slug: 'rust',
    type: LanguageType::Programming,
    extensions: ['.rs'],
    aliases: ['rust', 'rs'],
    year: 2010,
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['/*', '*/']],
        docComment: ['///', '///'],
        stringDelimiters: ['"'],
        typicalHeaders: ['use ', 'fn main()', 'mod '],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
