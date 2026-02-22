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
    name: 'Dockerfile',
    slug: 'dockerfile',
    type: LanguageType::Config,
    extensions: ['.dockerfile'],
    aliases: ['dockerfile', 'docker'],
    filenames: ['Dockerfile', 'Dockerfile.dev', 'Dockerfile.prod'],
    year: 2013,
    markers: new CodeMarkers(
        lineComments: ['#'],
        stringDelimiters: ['"', "'"],
        typicalHeaders: ['FROM '],
        blockStyle: BlockStyle::None,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
