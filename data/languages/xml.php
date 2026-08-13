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
    name: 'XML',
    slug: 'xml',
    type: LanguageType::Markup,
    extensions: ['.xml', '.xsd', '.xsl', '.xslt', '.wsdl'],
    aliases: ['xml', 'xsl', 'xslt'],
    year: 1998,
    markers: new CodeMarkers(
        blockComments: [['<!--', '-->']],
        stringDelimiters: ['"', "'"],
        openingTag: '<?xml',
        typicalHeaders: ['<?xml '],
        blockStyle: BlockStyle::Tags,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
