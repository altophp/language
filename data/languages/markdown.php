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
    name: 'Markdown',
    slug: 'markdown',
    type: LanguageType::Prose,
    extensions: ['.md', '.markdown', '.mdx'],
    aliases: ['markdown', 'md', 'mdx'],
    year: 2004,
    markers: new CodeMarkers(
        blockComments: [['<!--', '-->']],
        stringDelimiters: [],
        blockStyle: BlockStyle::None,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
