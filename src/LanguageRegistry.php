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
 * Injectable registry that indexes languages by slug, extension, alias, and filename.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final class LanguageRegistry
{
    /**
     * @var array<string, Language> slug → Language
     */
    private array $bySlug = [];

    /**
     * @var array<string, Language> extension → Language (first registered wins)
     */
    private array $byExtension = [];

    /**
     * @var array<string, Language> alias → Language
     */
    private array $byAlias = [];

    /**
     * @var array<string, Language> filename → Language
     */
    private array $byFilename = [];

    /**
     * @var array<string, string[]> index type → list of conflicting keys
     */
    private array $conflicts = [];

    private bool $loaded = false;

    public function __construct(
        private readonly ?string $dataDir = null,
    ) {}

    public function register(Language $language): void
    {
        $this->bySlug[$language->slug] = $language;

        foreach ($language->extensions as $ext) {
            if (isset($this->byExtension[$ext])) {
                $this->conflicts['extension'][] = $ext;
            }
            $this->byExtension[$ext] ??= $language;
        }

        foreach ($language->aliases as $alias) {
            $lower = strtolower($alias);
            if (isset($this->byAlias[$lower])) {
                $this->conflicts['alias'][] = $lower;
            }
            $this->byAlias[$lower] ??= $language;
        }

        foreach ($language->filenames as $filename) {
            if (isset($this->byFilename[$filename])) {
                $this->conflicts['filename'][] = $filename;
            }
            $this->byFilename[$filename] ??= $language;
        }
    }

    public function get(string $slug): ?Language
    {
        $this->boot();

        return $this->bySlug[$slug] ?? null;
    }

    public function fromExtension(string $extension): ?Language
    {
        $this->boot();

        if (!str_starts_with($extension, '.')) {
            $extension = '.' . $extension;
        }

        return $this->byExtension[strtolower($extension)] ?? null;
    }

    public function fromAlias(string $alias): ?Language
    {
        $this->boot();

        return $this->byAlias[strtolower($alias)] ?? null;
    }

    public function fromFilename(string $filename): ?Language
    {
        $this->boot();

        $basename = basename($filename);

        if (isset($this->byFilename[$basename])) {
            return $this->byFilename[$basename];
        }

        // Try progressively shorter extensions: .xml.dist → .dist, then .xml
        $remaining = $basename;
        while (($pos = strrpos($remaining, '.')) !== false) {
            $ext = strtolower(substr($remaining, $pos));
            if (isset($this->byExtension[$ext])) {
                return $this->byExtension[$ext];
            }
            $remaining = substr($remaining, 0, $pos);
        }

        return null;
    }

    /**
     * @return Language[]
     */
    public function all(): array
    {
        $this->boot();

        return array_values($this->bySlug);
    }

    /**
     * @return Language[]
     */
    public function ofType(LanguageType $type): array
    {
        $this->boot();

        return array_values(array_filter(
            $this->bySlug,
            static fn(Language $l): bool => $l->type === $type,
        ));
    }

    /**
     * Languages whose parent is the given slug.
     *
     * @return Language[]
     */
    public function children(string $slug): array
    {
        $this->boot();

        return array_values(array_filter(
            $this->bySlug,
            static fn(Language $l): bool => $l->parent === $slug,
        ));
    }

    /**
     * Resolve a language from any identifier: slug, alias, extension, or filename.
     */
    public function resolve(string $identifier): ?Language
    {
        return $this->get($identifier)
            ?? $this->fromAlias($identifier)
            ?? $this->fromExtension($identifier)
            ?? $this->fromFilename($identifier);
    }

    /**
     * Extension/alias/filename keys that were claimed by more than one language.
     *
     * @return array<string, string[]> index type → conflicting keys
     */
    public function conflicts(): array
    {
        $this->boot();

        return $this->conflicts;
    }

    private function boot(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->loaded = true;
        $this->loadDefinitions();
    }

    private function loadDefinitions(): void
    {
        $dir = $this->dataDir ?? dirname(__DIR__) . '/data/languages';
        if (!is_dir($dir)) {
            throw new \RuntimeException(sprintf('Languages directory not found in dir "%s".', $dir));
        }

        foreach (glob($dir . '/*.php') ?: [] as $file) {
            $language = require $file;

            if ($language instanceof Language) {
                $this->register($language);
            }
        }
    }
}
