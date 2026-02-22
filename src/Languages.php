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
 * Static facade for language lookups, backed by a singleton registry.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final class Languages
{
    private static ?LanguageRegistry $registry = null;

    public static function get(string $slug): ?Language
    {
        return self::registry()->get($slug);
    }

    public static function fromExtension(string $extension): ?Language
    {
        return self::registry()->fromExtension($extension);
    }

    public static function fromAlias(string $alias): ?Language
    {
        return self::registry()->fromAlias($alias);
    }

    public static function fromFilename(string $filename): ?Language
    {
        return self::registry()->fromFilename($filename);
    }

    /** @return Language[] */
    public static function all(): array
    {
        return self::registry()->all();
    }

    /** @return Language[] */
    public static function ofType(LanguageType $type): array
    {
        return self::registry()->ofType($type);
    }

    /** @return Language[] */
    public static function children(string $slug): array
    {
        return self::registry()->children($slug);
    }

    public static function resolve(string $identifier): ?Language
    {
        return self::registry()->resolve($identifier);
    }

    /**
     * @return array<string, string[]>
     */
    public static function conflicts(): array
    {
        return self::registry()->conflicts();
    }

    public static function registry(): LanguageRegistry
    {
        return self::$registry ??= new LanguageRegistry();
    }

    /**
     * Reset the singleton (for testing).
     */
    public static function reset(): void
    {
        self::$registry = null;
    }
}
