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
use Alto\Language\LanguageType;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(LanguageRegistry::class)]
final class LanguageRegistryTest extends TestCase
{
    public function testGetBySlug(): void
    {
        $registry = new LanguageRegistry();

        $php = $registry->get('php');
        self::assertNotNull($php);
        self::assertSame('PHP', $php->name);
        self::assertSame('php', $php->slug);
    }

    public function testGetUnknownReturnsNull(): void
    {
        $registry = new LanguageRegistry();
        self::assertNull($registry->get('nonexistent'));
    }

    public function testFromExtension(): void
    {
        $registry = new LanguageRegistry();

        self::assertSame('php', $registry->fromExtension('.php')?->slug);
        self::assertSame('php', $registry->fromExtension('php')?->slug);
        self::assertSame('javascript', $registry->fromExtension('.js')?->slug);
    }

    public function testFromAlias(): void
    {
        $registry = new LanguageRegistry();

        self::assertSame('python', $registry->fromAlias('py')?->slug);
        self::assertSame('python', $registry->fromAlias('python3')?->slug);
        self::assertSame('javascript', $registry->fromAlias('js')?->slug);
    }

    public function testFromFilename(): void
    {
        $registry = new LanguageRegistry();

        self::assertSame('php', $registry->fromFilename('index.php')?->slug);
        self::assertSame('javascript', $registry->fromFilename('src/app.js')?->slug);
    }

    public function testFromFilenameWithCompoundExtension(): void
    {
        $registry = new LanguageRegistry();

        // Assuming .xml.dist is not explicitly registered but .xml is.
        // If .xml.dist were registered, it would match that first.
        // If not, it should fall back to .dist (if registered) or .xml.

        // Let's register a custom language to test this behavior deterministically
        $xml = new Language(
            name: 'XML',
            slug: 'xml',
            type: LanguageType::Data,
            extensions: ['.xml'],
        );
        $registry->register($xml);

        self::assertSame('xml', $registry->fromFilename('config.xml.dist')?->slug);
    }

    public function testAll(): void
    {
        $registry = new LanguageRegistry();
        $all = $registry->all();

        self::assertNotEmpty($all);

        $slugs = array_map(fn(Language $l) => $l->slug, $all);
        self::assertContains('php', $slugs);
        self::assertContains('javascript', $slugs);
        self::assertContains('python', $slugs);
    }

    public function testOfType(): void
    {
        $registry = new LanguageRegistry();

        $stylesheets = $registry->ofType(LanguageType::Stylesheet);
        self::assertNotEmpty($stylesheets);

        foreach ($stylesheets as $lang) {
            self::assertSame(LanguageType::Stylesheet, $lang->type);
        }
    }

    public function testResolve(): void
    {
        $registry = new LanguageRegistry();

        self::assertSame('php', $registry->resolve('php')?->slug);
        self::assertSame('python', $registry->resolve('py')?->slug);
        self::assertSame('javascript', $registry->resolve('.js')?->slug);
        self::assertNull($registry->resolve('nonexistent'));
    }

    public function testRegisterCustomLanguage(): void
    {
        $registry = new LanguageRegistry();

        $custom = new Language(
            name: 'Custom',
            slug: 'custom',
            type: LanguageType::Programming,
            extensions: ['.custom'],
            aliases: ['cust'],
        );

        $registry->register($custom);

        self::assertSame('custom', $registry->get('custom')?->slug);
        self::assertSame('custom', $registry->fromExtension('.custom')?->slug);
        self::assertSame('custom', $registry->fromAlias('cust')?->slug);
    }

    public function testFromFilenameExact(): void
    {
        $registry = new LanguageRegistry();
        self::assertSame('makefile', $registry->fromFilename('Makefile')?->slug);
    }

    public function testFromFilenameDockerfile(): void
    {
        $registry = new LanguageRegistry();
        self::assertSame('dockerfile', $registry->fromFilename('Dockerfile')?->slug);
    }

    public function testFromFilenameWithPath(): void
    {
        $registry = new LanguageRegistry();
        self::assertSame('makefile', $registry->fromFilename('/path/to/Makefile')?->slug);
    }

    public function testFromFilenameUnknownReturnsNull(): void
    {
        $registry = new LanguageRegistry();
        self::assertNull($registry->fromFilename('some-random-unknown-file'));
    }

    public function testChildren(): void
    {
        $registry = new LanguageRegistry();
        $children = $registry->children('javascript');
        $slugs = array_map(fn(Language $l) => $l->slug, $children);

        self::assertContains('typescript', $slugs);
        self::assertContains('coffeescript', $slugs);
    }

    public function testChildrenEmpty(): void
    {
        $registry = new LanguageRegistry();
        self::assertSame([], $registry->children('zig'));
    }

    public function testConflictsOnCleanRegistry(): void
    {
        $registry = new LanguageRegistry();
        self::assertSame([], $registry->conflicts());
    }

    public function testConflictsDetected(): void
    {
        $registry = new LanguageRegistry();

        $lang1 = new Language(
            name: 'LangA',
            slug: 'lang-a',
            type: LanguageType::Programming,
            extensions: ['.dup'],
        );
        $lang2 = new Language(
            name: 'LangB',
            slug: 'lang-b',
            type: LanguageType::Programming,
            extensions: ['.dup'],
        );

        $registry->register($lang1);
        $registry->register($lang2);

        $conflicts = $registry->conflicts();
        self::assertArrayHasKey('extension', $conflicts);
        self::assertContains('.dup', $conflicts['extension']);
    }

    public function testConflictsDetectedForAliases(): void
    {
        $registry = new LanguageRegistry();

        $lang1 = new Language(
            name: 'LangA',
            slug: 'lang-a',
            type: LanguageType::Programming,
            aliases: ['dupalias'],
        );
        $lang2 = new Language(
            name: 'LangB',
            slug: 'lang-b',
            type: LanguageType::Programming,
            aliases: ['dupalias'],
        );

        $registry->register($lang1);
        $registry->register($lang2);

        $conflicts = $registry->conflicts();
        self::assertArrayHasKey('alias', $conflicts);
        self::assertContains('dupalias', $conflicts['alias']);
    }

    public function testConflictsDetectedForFilenames(): void
    {
        $registry = new LanguageRegistry();

        $lang1 = new Language(
            name: 'LangA',
            slug: 'lang-a',
            type: LanguageType::Programming,
            filenames: ['dupfile'],
        );
        $lang2 = new Language(
            name: 'LangB',
            slug: 'lang-b',
            type: LanguageType::Programming,
            filenames: ['dupfile'],
        );

        $registry->register($lang1);
        $registry->register($lang2);

        $conflicts = $registry->conflicts();
        self::assertArrayHasKey('filename', $conflicts);
        self::assertContains('dupfile', $conflicts['filename']);
    }

    public function testLoadDefinitionsThrowsWhenDirectoryNotFound(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Languages directory not found');

        $registry = new LanguageRegistry('/nonexistent/path');
        $registry->all();
    }

    public function testCustomDataDirLoadsDefinitions(): void
    {
        $dir = sys_get_temp_dir() . '/alto-lang-test-' . uniqid('', true);
        mkdir($dir);

        file_put_contents($dir . '/test.php', "<?php
use Alto\\Language\\Language;
use Alto\\Language\\LanguageType;
return new Language(name: 'Test Lang', slug: 'test-lang', type: LanguageType::Programming, extensions: ['.tst']);
");

        $registry = new LanguageRegistry($dir);
        $lang = $registry->get('test-lang');

        self::assertNotNull($lang);
        self::assertSame('Test Lang', $lang->name);
        self::assertCount(1, $registry->all());

        unlink($dir . '/test.php');
        rmdir($dir);
    }

    public function testLoadDefinitionsSkipsNonLanguageReturns(): void
    {
        $dir = sys_get_temp_dir() . '/alto-lang-test-' . uniqid('', true);
        mkdir($dir);

        file_put_contents($dir . '/notlang.php', '<?php return "not a language";');

        $registry = new LanguageRegistry($dir);
        self::assertCount(0, $registry->all());

        unlink($dir . '/notlang.php');
        rmdir($dir);
    }
}
