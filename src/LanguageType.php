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

namespace Alto\Language;

/**
 * Categorizes languages by their primary purpose and usage domain.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
enum LanguageType: string
{
    case Programming = 'programming';
    case Markup = 'markup';
    case Data = 'data';
    case Prose = 'prose';
    case Query = 'query';
    case Stylesheet = 'stylesheet';
    case Template = 'template';
    case Config = 'config';
    case Other = 'other';
}
