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
    name: 'CSS',
    slug: 'css',
    type: LanguageType::Stylesheet,
    extensions: ['.css'],
    aliases: ['css'],
    year: 1996,
    markers: new CodeMarkers(
        blockComments: [['/*', '*/']],
        stringDelimiters: ['"', "'"],
        typicalHeaders: ['@charset', '@import'],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
