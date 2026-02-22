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

use Alto\Code\Language\Languages;
use Alto\Code\Language\LanguageType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Languages::class)]
final class LanguagesTest extends TestCase
{
    protected function setUp(): void
    {
        Languages::reset();
    }

    public function testGet(): void
    {
        self::assertSame('PHP', Languages::get('php')?->name);
        self::assertNull(Languages::get('nonexistent'));
    }

    public function testFromExtension(): void
    {
        self::assertSame('typescript', Languages::fromExtension('.ts')?->slug);
    }

    public function testFromAlias(): void
    {
        self::assertSame('go', Languages::fromAlias('golang')?->slug);
    }

    public function testFromFilename(): void
    {
        self::assertSame('rust', Languages::fromFilename('main.rs')?->slug);
    }

    public function testAll(): void
    {
        $all = Languages::all();
        self::assertGreaterThanOrEqual(50, count($all));
    }

    public function testOfType(): void
    {
        $queries = Languages::ofType(LanguageType::Query);
        self::assertNotEmpty($queries);

        $slugs = array_map(fn ($l) => $l->slug, $queries);
        self::assertContains('sql', $slugs);
        self::assertContains('graphql', $slugs);
    }

    public function testResolve(): void
    {
        self::assertSame('ruby', Languages::resolve('rb')?->slug);
    }

    public function testRegistry(): void
    {
        $registry = Languages::registry();
        self::assertNotNull($registry->get('php'));
    }

    public function testChildren(): void
    {
        $children = Languages::children('css');
        $slugs = array_map(fn ($l) => $l->slug, $children);

        self::assertContains('sass', $slugs);
        self::assertContains('scss', $slugs);
        self::assertContains('less', $slugs);
    }

    public function testConflicts(): void
    {
        self::assertIsArray(Languages::conflicts());
    }
}
