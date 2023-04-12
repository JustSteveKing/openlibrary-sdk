<?php

declare(strict_types=1);

use JustSteveKing\OpenLibrary\Tests\TestCase;
use JustSteveKing\Tools\Http\Enums\Status;
use JustSteveKing\Tools\Http\Payload;
use Nyholm\Psr7\Response;

uses(TestCase::class)->in(__DIR__);

function buildResponse(Status $status, string $name): Response
{
    return new Response(
        status: $status->value,
        body: (new Payload(
            content: fixture($name),
        ))->toStream(),
    );
}

function fixture(string $name): string
{
    if ( ! file_exists(filename: __DIR__."/Fixtures/{$name}.json")) {
        throw new InvalidArgumentException(
            message: "Fixture not found [{$name}].",
        );
    }

    return (string) file_get_contents(
        filename: __DIR__."/Fixtures/{$name}.json",
    );
}
