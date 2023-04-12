<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary;

use JustSteveKing\OpenLibrary\Resources\AuthorResource;
use JustSteveKing\OpenLibrary\Resources\BookResource;
use JustSteveKing\Tools\SDK\SDK;
use JustSteveKing\Tools\SDK\Transport\HttpTransport;

final class Client extends SDK
{
    public static function build(): Client
    {
        return new Client(
            client: HttpTransport::client(),
        );
    }

    public function authors(): AuthorResource
    {
        return new AuthorResource(
            sdk: $this,
        );
    }

    public function works(): BookResource
    {
        return new BookResource(
            sdk: $this,
        );
    }
}
