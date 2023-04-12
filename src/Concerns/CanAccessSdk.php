<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\Concerns;

use JustSteveKing\Tools\Contracts\SDK\SDKContract;

trait CanAccessSdk
{
    public function __construct(
        private readonly SDKContract $sdk,
    ) {
    }

    public function sdk(): SDKContract
    {
        return $this->sdk;
    }
}
