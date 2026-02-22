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
 * Defines whether code should be indented with spaces or tabs.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
enum IndentStyle: string
{
    case Spaces = 'spaces';
    case Tabs = 'tabs';
}
