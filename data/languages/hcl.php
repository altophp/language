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
    name: 'HCL',
    slug: 'hcl',
    type: LanguageType::Config,
    extensions: ['.hcl', '.tf', '.tfvars'],
    aliases: ['hcl', 'terraform', 'tf'],
    year: 2014,
    markers: new CodeMarkers(
        lineComments: ['#', '//'],
        blockComments: [['/*', '*/']],
        stringDelimiters: ['"'],
        heredoc: true,
        typicalHeaders: ['resource ', 'variable ', 'provider '],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
