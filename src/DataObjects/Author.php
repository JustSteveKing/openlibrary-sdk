<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\DataObjects;

use Carbon\CarbonInterface;

final class Author
{
    public function __construct(
        public readonly string $title,
        public readonly string $wikipedia,
        public readonly string $name,
        public readonly string $bio,
        public readonly CarbonInterface $birth,
        public readonly null|CarbonInterface $death,
        public readonly array $photos,
        public readonly array $records,
        public readonly array $ids,
        public readonly array $links,
    ) {
    }
}
