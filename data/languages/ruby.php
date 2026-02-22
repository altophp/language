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
    name: 'Ruby',
    slug: 'ruby',
    type: LanguageType::Programming,
    extensions: ['.rb', '.rake', '.gemspec'],
    aliases: ['ruby', 'rb'],
    filenames: ['Gemfile', 'Rakefile', 'Guardfile', 'Vagrantfile', 'Podfile', 'Capfile', 'Brewfile', 'Berksfile'],
    year: 1995,
    markers: new CodeMarkers(
        lineComments: ['#'],
        blockComments: [['=begin', '=end']],
        stringDelimiters: ['"', "'", '`'],
        heredoc: true,
        shebang: '#!/usr/bin/env ruby',
        typicalHeaders: ['#!/usr/bin/env ruby', 'require '],
        blockStyle: BlockStyle::BeginEnd,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
