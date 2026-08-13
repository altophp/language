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
    name: 'Bash',
    slug: 'bash',
    type: LanguageType::Programming,
    extensions: ['.sh', '.bash', '.zsh'],
    aliases: ['bash', 'sh', 'shell', 'zsh'],
    filenames: ['.bashrc', '.bash_profile', '.bash_logout', '.profile'],
    year: 1989,
    markers: new CodeMarkers(
        lineComments: ['#'],
        stringDelimiters: ['"', "'", '`'],
        heredoc: true,
        shebang: '#!/bin/bash',
        typicalHeaders: ['#!/bin/bash', '#!/usr/bin/env bash'],
        blockStyle: BlockStyle::BeginEnd,
        defaultIndentation: 2,
        indentStyle: IndentStyle::Spaces,
    ),
);
