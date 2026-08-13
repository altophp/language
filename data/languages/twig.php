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
    name: 'Twig',
    slug: 'twig',
    type: LanguageType::Template,
    extensions: ['.twig', '.html.twig'],
    aliases: ['twig'],
    year: 2009,
    markers: new CodeMarkers(
        blockComments: [['{#', '#}']],
        stringDelimiters: ['"', "'"],
        openingTag: '{%',
        typicalHeaders: ['{% extends', '{% block'],
        blockStyle: BlockStyle::Tags,
        defaultIndentation: 4,
        indentStyle: IndentStyle::Spaces,
    ),
);
