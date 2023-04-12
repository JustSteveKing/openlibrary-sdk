<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\DataObjects;

use Carbon\CarbonInterface;

final class Work
{
    public function __construct(
        public readonly string $title,
        public readonly null|string $subTitle,
        public readonly int $latestRevision,
        public readonly int $revision,
        public readonly CarbonInterface $created,
        public readonly CarbonInterface $modified,
        public readonly array $subjects,
        public readonly array $covers,
    ) {}
}
