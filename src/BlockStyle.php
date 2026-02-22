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

namespace Alto\Language;

/**
 * Defines how a language structures code blocks and scope boundaries.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
enum BlockStyle: string
{
    case Braces = 'braces';
    case Indentation = 'indentation';
    case BeginEnd = 'begin-end';
    case Tags = 'tags';
    case None = 'none';
}
