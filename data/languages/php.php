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
    name: 'PHP',
    slug: 'php',
    type: LanguageType::Programming,
    extensions: ['.php', '.phtml', '.php3', '.php4', '.php5', '.phps'],
    aliases: ['php', 'php5', 'php7', 'php8'],
    year: 1995,
    markers: new CodeMarkers(
        lineComments: ['//', '#'],
        blockComments: [['/*', '*/']],
        docComment: ['/**', '*/'],
        stringDelimiters: ['"', "'"],
        heredoc: true,
        shebang: '#!/usr/bin/env php',
        openingTag: '<?php',
        typicalHeaders: ['<?php'],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
