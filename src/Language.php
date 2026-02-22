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
 * Immutable value object representing a programming language and its metadata.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final readonly class Language implements \JsonSerializable
{
    /**
     * @param string       $name       Display name
     * @param string       $slug       Machine identifier (lowercase, hyphenated)
     * @param LanguageType $type       Category of language
     * @param string[]     $extensions File extensions (including dot)
     * @param string[]     $aliases    alternative identifiers used in fences, shebangs, etc
     * @param string[]     $filenames  Exact filenames (e.g. "Makefile", "Dockerfile")
     * @param int|null     $year       Year of first public release
     * @param string|null  $parent     Slug of parent language (e.g. "javascript" for TypeScript)
     * @param CodeMarkers  $markers    Syntax identification data
     */
    public function __construct(
        public string $name,
        public string $slug,
        public LanguageType $type,
        public array $extensions = [],
        public array $aliases = [],
        public array $filenames = [],
        public ?int $year = null,
        public ?string $parent = null,
        public CodeMarkers $markers = new CodeMarkers(),
    ) {
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type->value,
            'extensions' => $this->extensions,
            'aliases' => $this->aliases,
            'filenames' => $this->filenames,
            'year' => $this->year,
            'parent' => $this->parent,
            'markers' => $this->markers->toArray(),
        ];
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
