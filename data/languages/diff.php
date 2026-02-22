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
    name: 'Diff',
    slug: 'diff',
    type: LanguageType::Other,
    extensions: ['.diff', '.patch'],
    aliases: ['diff', 'patch', 'udiff'],
    markers: new CodeMarkers(
        stringDelimiters: [],
        typicalHeaders: ['--- ', '+++ ', 'diff --git'],
        blockStyle: BlockStyle::None,
        defaultIndentation: 0,
        indentStyle: IndentStyle::Spaces,
    ),
);
