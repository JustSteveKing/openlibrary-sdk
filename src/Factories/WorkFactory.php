<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\Factories;

use Carbon\Carbon;
use JustSteveKing\OpenLibrary\DataObjects\Work;

final class WorkFactory
{
    public static function make(array $data): Work
    {
        return new Work(
            title: $data['title'],
            subTitle: $data['subtitle'] ?? null,
            latestRevision: $data['latest_revision'],
            revision: $data['revision'],
            created: Carbon::parse(
                time: $data['created']['value'],
            ),
            modified: Carbon::parse(
                time: $data['last_modified']['value'],
            ),
            subjects: $data['subjects'],
            covers: $data['covers'],
        );
    }
}
