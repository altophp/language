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
    name: 'CoffeeScript',
    slug: 'coffeescript',
    type: LanguageType::Programming,
    extensions: ['.coffee', '.litcoffee'],
    aliases: ['coffeescript', 'coffee'],
    year: 2009,
    parent: 'javascript',
    markers: new CodeMarkers(
        lineComments: ['#'],
        blockComments: [['###', '###']],
        stringDelimiters: ['"', "'", '"""'],
        heredoc: true,
        typicalHeaders: ['class ', '# '],
        blockStyle: BlockStyle::Indentation,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
