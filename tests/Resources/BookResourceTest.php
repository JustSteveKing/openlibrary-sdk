<?php

declare(strict_types=1);

use Http\Mock\Client as MockClient;
use JustSteveKing\OpenLibrary\Client;
use JustSteveKing\OpenLibrary\DataObjects\Work;
use JustSteveKing\Tools\Http\Enums\Status;

it('can fetch a book', function (string $id): void {
    $mock = new MockClient();
    $mock->addResponse(
        response: buildResponse(
            status: Status::OK,
            name: 'works/fetch',
        ),
    );

    $client = Client::build();
    $client->setClient($mock);

    $work = $client->works()->fetch($id);

    expect(
        $work,
    )->toBeInstanceOf(Work::class)->title->toEqual('Science of Discworld IV');
})->with('books');
