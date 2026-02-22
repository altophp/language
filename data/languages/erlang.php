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
    name: 'Erlang',
    slug: 'erlang',
    type: LanguageType::Programming,
    extensions: ['.erl', '.hrl'],
    aliases: ['erlang', 'erl'],
    year: 1986,
    markers: new CodeMarkers(
        lineComments: ['%'],
        stringDelimiters: ['"'],
        typicalHeaders: ['-module(', '-export('],
        blockStyle: BlockStyle::BeginEnd,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
