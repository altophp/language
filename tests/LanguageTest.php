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

namespace Alto\Code\Language\Tests;

use Alto\Code\Language\BlockStyle;
use Alto\Code\Language\CodeMarkers;
use Alto\Code\Language\IndentStyle;
use Alto\Code\Language\Language;
use Alto\Code\Language\LanguageType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Language::class)]
#[CoversClass(CodeMarkers::class)]
final class LanguageTest extends TestCase
{
    public function testConstruction(): void
    {
        $markers = new CodeMarkers(
            lineComments: ['//'],
            blockComments: [['/*', '*/']],
            blockStyle: BlockStyle::Braces,
        );

        $language = new Language(
            name: 'TestLang',
            slug: 'testlang',
            type: LanguageType::Programming,
            extensions: ['.tl'],
            aliases: ['testlang', 'tl'],
            year: 2024,
            parent: 'c',
            markers: $markers,
        );

        self::assertSame('TestLang', $language->name);
        self::assertSame('testlang', $language->slug);
        self::assertSame(LanguageType::Programming, $language->type);
        self::assertSame(['.tl'], $language->extensions);
        self::assertSame(['testlang', 'tl'], $language->aliases);
        self::assertSame(2024, $language->year);
        self::assertSame('c', $language->parent);
        self::assertSame($markers, $language->markers);
    }

    public function testDefaults(): void
    {
        $language = new Language(
            name: 'Minimal',
            slug: 'minimal',
            type: LanguageType::Other,
        );

        self::assertSame([], $language->extensions);
        self::assertSame([], $language->aliases);
        self::assertNull($language->year);
        self::assertNull($language->parent);
        self::assertInstanceOf(CodeMarkers::class, $language->markers);
    }

    public function testCodeMarkersDefaults(): void
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

    public function testFilenamesProperty(): void
    {
        $language = new Language(
            name: 'Make',
            slug: 'makefile',
            type: LanguageType::Programming,
            filenames: ['Makefile'],
        );

        self::assertSame(['Makefile'], $language->filenames);
    }

    public function testDefaultFilenames(): void
    {
        $language = new Language(
            name: 'Minimal',
            slug: 'minimal',
            type: LanguageType::Other,
        );

        self::assertSame([], $language->filenames);
    }

    public function testToArray(): void
    {
        $markers = new CodeMarkers(
            lineComments: ['//'],
            blockComments: [['/*', '*/']],
            blockStyle: BlockStyle::Braces,
            indentStyle: IndentStyle::Spaces,
        );

        $language = new Language(
            name: 'TestLang',
            slug: 'testlang',
            type: LanguageType::Programming,
            extensions: ['.tl'],
            aliases: ['testlang'],
            filenames: ['Testfile'],
            year: 2024,
            parent: 'c',
            markers: $markers,
        );

        $array = $language->toArray();

        self::assertSame('TestLang', $array['name']);
        self::assertSame('testlang', $array['slug']);
        self::assertSame('programming', $array['type']);
        self::assertSame(['.tl'], $array['extensions']);
        self::assertSame(['testlang'], $array['aliases']);
        self::assertSame(['Testfile'], $array['filenames']);
        self::assertSame(2024, $array['year']);
        self::assertSame('c', $array['parent']);
        self::assertIsArray($array['markers']);
    }

    public function testJsonSerialize(): void
    {
        $language = new Language(
            name: 'JsonTest',
            slug: 'jsontest',
            type: LanguageType::Data,
        );

        $json = json_encode($language);
        self::assertIsString($json);

        $decoded = json_decode($json, true);
        self::assertSame($language->toArray(), $decoded);
    }

    public function testCodeMarkersToArray(): void
    {
        $markers = new CodeMarkers(
            lineComments: ['#'],
            blockComments: [],
            blockStyle: BlockStyle::Indentation,
            indentStyle: IndentStyle::Spaces,
        );

        $array = $markers->toArray();

        self::assertArrayHasKey('lineComments', $array);
        self::assertArrayHasKey('blockComments', $array);
        self::assertArrayHasKey('docComment', $array);
        self::assertArrayHasKey('stringDelimiters', $array);
        self::assertArrayHasKey('heredoc', $array);
        self::assertArrayHasKey('shebang', $array);
        self::assertArrayHasKey('openingTag', $array);
        self::assertArrayHasKey('typicalHeaders', $array);
        self::assertArrayHasKey('blockStyle', $array);
        self::assertArrayHasKey('defaultIndentation', $array);
        self::assertArrayHasKey('indentStyle', $array);
        self::assertSame('indentation', $array['blockStyle']);
        self::assertSame('spaces', $array['indentStyle']);
    }
}
