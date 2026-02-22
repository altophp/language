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
    name: 'Objective-C',
    slug: 'objective-c',
    type: LanguageType::Programming,
    extensions: ['.m', '.mm'],
    aliases: ['objective-c', 'objc', 'objectivec'],
    year: 1984,
    parent: 'c',
    markers: new CodeMarkers(
        lineComments: ['//'],
        blockComments: [['/*', '*/']],
        stringDelimiters: ['"', "'"],
        typicalHeaders: ['#import ', '@interface ', '@implementation '],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
