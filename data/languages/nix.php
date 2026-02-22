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
    name: 'Nix',
    slug: 'nix',
    type: LanguageType::Config,
    extensions: ['.nix'],
    aliases: ['nix', 'nixos'],
    year: 2003,
    markers: new CodeMarkers(
        lineComments: ['#'],
        blockComments: [['/*', '*/']],
        stringDelimiters: ['"', "''"],
        heredoc: true,
        typicalHeaders: ['{ pkgs', 'let', 'with '],
        blockStyle: BlockStyle::Braces,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
