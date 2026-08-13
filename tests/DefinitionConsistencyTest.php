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

namespace Alto\Language\Tests;

use Alto\Language\Language;
use Alto\Language\LanguageRegistry;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Validates consistency across all language definitions.
 */
#[CoversClass(LanguageRegistry::class)]
final class DefinitionConsistencyTest extends TestCase
{
    private static LanguageRegistry $registry;

    public static function setUpBeforeClass(): void
    {
        self::$registry = new LanguageRegistry();
    }

    public function testAllDefinitionsLoad(): void
    {
        $all = self::$registry->all();
        self::assertNotEmpty($all);

        foreach ($all as $language) {
            self::assertInstanceOf(Language::class, $language);
            self::assertNotEmpty($language->name, "Language slug '{$language->slug}' has empty name");
            self::assertNotEmpty($language->slug, "Language '{$language->name}' has empty slug");
        }
    }

    public function testSlugsAreUnique(): void
    {
        $slugs = array_map(fn(Language $l) => $l->slug, self::$registry->all());
        self::assertSame($slugs, array_unique($slugs), 'Duplicate slugs found');
    }

    public function testExtensionsStartWithDot(): void
    {
        foreach (self::$registry->all() as $language) {
            foreach ($language->extensions as $ext) {
                self::assertStringStartsWith('.', $ext, "Extension '{$ext}' in '{$language->slug}' must start with '.'");
            }
        }
    }

    public function testAliasesAreLowercase(): void
    {
        foreach (self::$registry->all() as $language) {
            foreach ($language->aliases as $alias) {
                self::assertSame(
                    strtolower($alias),
                    $alias,
                    "Alias '{$alias}' in '{$language->slug}' should be lowercase",
                );
            }
        }
    }

    public function testParentReferencesExist(): void
    {
        foreach (self::$registry->all() as $language) {
            if (null !== $language->parent) {
                self::assertNotNull(
                    self::$registry->get($language->parent),
                    "Parent '{$language->parent}' referenced by '{$language->slug}' does not exist",
                );
            }
        }
    }

    public function testSlugIsLowercaseAndHyphenated(): void
    {
        foreach (self::$registry->all() as $language) {
            self::assertMatchesRegularExpression(
                '/^[a-z][a-z0-9-]*$/',
                $language->slug,
                "Slug '{$language->slug}' must be lowercase alphanumeric with hyphens",
            );
        }
    }

    public function testSlugIsIncludedInAliases(): void
    {
        foreach (self::$registry->all() as $language) {
            if ([] !== $language->aliases) {
                self::assertContains(
                    $language->slug,
                    $language->aliases,
                    "Slug '{$language->slug}' should appear in its own aliases",
                );
            }
        }
    }

    public function testFilenamesAreNotEmpty(): void
    {
        foreach (self::$registry->all() as $language) {
            foreach ($language->filenames as $filename) {
                self::assertNotEmpty($filename, "Filename in '{$language->slug}' must not be empty");
            }
        }
    }

    public function testFilenamesAreUnique(): void
    {
        $seen = [];
        foreach (self::$registry->all() as $language) {
            foreach ($language->filenames as $filename) {
                self::assertFalse(
                    isset($seen[$filename]),
                    \sprintf("Filename '%s' is duplicated in '%s' and '%s'", $filename, $seen[$filename] ?? '', $language->slug),
                );
                $seen[$filename] = $language->slug;
            }
        }
    }
}
