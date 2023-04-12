<?php

declare(strict_types=1);

use JustSteveKing\OpenLibrary\Client;
use JustSteveKing\OpenLibrary\Resources\AuthorResource;
use JustSteveKing\Tools\SDK\SDK;

it('can build a new Client')
    ->expect(fn () => Client::build())
    ->toBeInstanceOf(SDK::class);

it('can get the authors resource')
    ->expect(fn () => Client::build()->authors())
    ->toBeInstanceOf(AuthorResource::class);
