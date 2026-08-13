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
 * Syntactic fingerprints for identifying and parsing a language in mixed content.
 *
 * @author Simon André <smn.andre@gmail.com>
 */
final readonly class CodeMarkers implements \JsonSerializable
{
    /**
     * @param string[]      $lineComments     Single-line comment prefixes — e.g. ["//"], ["#"]
     * @param string[][]    $blockComments    Open/close pairs — e.g. [["/*", "*\/"]]
     * @param string[]|null $docComment       Doc-comment pair — e.g. ["/**", "*\/"]
     * @param string[]      $stringDelimiters Quote characters — e.g. ["\"", "'", "`"]
     * @param string|null   $shebang          Typical shebang — e.g. "#!/usr/bin/env python"
     * @param string|null   $openingTag       Language-specific tag — e.g. "<?php"
     * @param string[]      $typicalHeaders   Common first-line patterns — e.g. ["package main"]
     */
    public function __construct(
        public array $lineComments = [],
        public array $blockComments = [],
        public ?array $docComment = null,
        public array $stringDelimiters = ['"', "'"],
        public bool $heredoc = false,
        public ?string $shebang = null,
        public ?string $openingTag = null,
        public array $typicalHeaders = [],
        public BlockStyle $blockStyle = BlockStyle::Braces,
        public int $defaultIndentation = 4,
        public IndentStyle $indentStyle = IndentStyle::Spaces,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'lineComments' => $this->lineComments,
            'blockComments' => $this->blockComments,
            'docComment' => $this->docComment,
            'stringDelimiters' => $this->stringDelimiters,
            'heredoc' => $this->heredoc,
            'shebang' => $this->shebang,
            'openingTag' => $this->openingTag,
            'typicalHeaders' => $this->typicalHeaders,
            'blockStyle' => $this->blockStyle->value,
            'defaultIndentation' => $this->defaultIndentation,
            'indentStyle' => $this->indentStyle->value,
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
