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
    name: 'Git Attributes',
    slug: 'gitattributes',
    type: LanguageType::Config,
    aliases: ['gitattributes'],
    filenames: ['.gitattributes'],
    markers: new CodeMarkers(
        lineComments: ['#'],
        stringDelimiters: ['"'],
        blockStyle: BlockStyle::None,
        defaultIndentation: 0,
        indentStyle: IndentStyle::Spaces,
    ),
);
