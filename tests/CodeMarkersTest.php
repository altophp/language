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

namespace Alto\Language\Tests;

use Alto\Language\BlockStyle;
use Alto\Language\CodeMarkers;
use Alto\Language\IndentStyle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CodeMarkers::class)]
final class CodeMarkersTest extends TestCase
{
    public function testDefaults(): void
    {
        $markers = new CodeMarkers();

        self::assertSame([], $markers->lineComments);
        self::assertSame([], $markers->blockComments);
        self::assertNull($markers->docComment);
        self::assertSame(['"', "'"], $markers->stringDelimiters);
        self::assertFalse($markers->heredoc);
        self::assertNull($markers->shebang);
        self::assertNull($markers->openingTag);
        self::assertSame([], $markers->typicalHeaders);
        self::assertSame(BlockStyle::Braces, $markers->blockStyle);
        self::assertSame(4, $markers->defaultIndentation);
        self::assertSame(IndentStyle::Spaces, $markers->indentStyle);
    }

    public function testCustomValues(): void
    {
        $markers = new CodeMarkers(
            lineComments: ['//', '#'],
            blockComments: [['/*', '*/']],
            docComment: ['/**', '*/'],
            stringDelimiters: ['"', "'", '`'],
            heredoc: true,
            shebang: '#!/usr/bin/env python',
            openingTag: '<?php',
            typicalHeaders: ['package main'],
            blockStyle: BlockStyle::Indentation,
            defaultIndentation: 2,
            indentStyle: IndentStyle::Tabs,
        );

        self::assertSame(['//', '#'], $markers->lineComments);
        self::assertSame([['/*', '*/']], $markers->blockComments);
        self::assertSame(['/**', '*/'], $markers->docComment);
        self::assertSame(['"', "'", '`'], $markers->stringDelimiters);
        self::assertTrue($markers->heredoc);
        self::assertSame('#!/usr/bin/env python', $markers->shebang);
        self::assertSame('<?php', $markers->openingTag);
        self::assertSame(['package main'], $markers->typicalHeaders);
        self::assertSame(BlockStyle::Indentation, $markers->blockStyle);
        self::assertSame(2, $markers->defaultIndentation);
        self::assertSame(IndentStyle::Tabs, $markers->indentStyle);
    }

    public function testJsonSerialize(): void
    {
        $markers = new CodeMarkers(
            lineComments: ['//'],
            blockStyle: BlockStyle::Indentation,
            indentStyle: IndentStyle::Tabs,
        );

        $expected = [
            'lineComments' => ['//'],
            'blockComments' => [],
            'docComment' => null,
            'stringDelimiters' => ['"', "'"],
            'heredoc' => false,
            'shebang' => null,
            'openingTag' => null,
            'typicalHeaders' => [],
            'blockStyle' => 'indentation',
            'defaultIndentation' => 4,
            'indentStyle' => 'tabs',
        ];

        self::assertSame($expected, $markers->toArray());
        self::assertSame($expected, $markers->jsonSerialize());
        self::assertJsonStringEqualsJsonString(json_encode($expected, JSON_THROW_ON_ERROR), json_encode($markers, JSON_THROW_ON_ERROR));
    }
}
