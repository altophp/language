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
    name: 'HTML',
    slug: 'html',
    type: LanguageType::Markup,
    extensions: ['.html', '.htm', '.xhtml'],
    aliases: ['html', 'htm', 'xhtml'],
    year: 1993,
    markers: new CodeMarkers(
        blockComments: [['<!--', '-->']],
        stringDelimiters: ['"', "'"],
        openingTag: '<!DOCTYPE html>',
        typicalHeaders: ['<!DOCTYPE html>', '<html'],
        blockStyle: BlockStyle::Tags,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
