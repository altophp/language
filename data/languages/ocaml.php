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
    name: 'OCaml',
    slug: 'ocaml',
    type: LanguageType::Programming,
    extensions: ['.ml', '.mli'],
    aliases: ['ocaml'],
    year: 1996,
    markers: new CodeMarkers(
        blockComments: [['(*', '*)']],
        stringDelimiters: ['"'],
        typicalHeaders: ['open ', 'let ', 'module '],
        blockStyle: BlockStyle::BeginEnd,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
