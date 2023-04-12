<?php

declare(strict_types=1);

use Http\Mock\Client as MockClient;
use JustSteveKing\OpenLibrary\Client;
use JustSteveKing\OpenLibrary\DataObjects\Author;
use JustSteveKing\OpenLibrary\Enums\Size;
use JustSteveKing\Tools\Contracts\Http\ResponseContract;
use JustSteveKing\Tools\Http\Enums\Status;

it('can fetch an author', function (string $id): void {
    $mock = new MockClient();
    $mock->addResponse(
        response: buildResponse(
            status: Status::OK,
            name: 'authors/fetch',
        ),
    );

    $client = Client::build();
    $client->setClient($mock);

    $author = $client->authors()->fetch($id);

    expect(
        $author,
    )->toBeInstanceOf(Author::class)->title->toEqual('Sir');
})->with('authors');

it('can get an authors works', function (string $id): void {
    $mock = new MockClient();
    $mock->addResponse(
        response: buildResponse(
            status: Status::OK,
            name: 'authors/works',
        ),
    );

    $client = Client::build();
    $client->setClient($mock);

    $works = $client->authors()->works(
        identifier: $id,
    );

    expect(
        $works,
    )->toBeArray()->not->toBeEmpty();
})->with('authors');

it('can fetch the authors image', function (string $id): void {
    $mock = new MockClient();

    $client = Client::build();
    $client->setClient($mock);

    $image = $client->authors()->image(
        identifier: $id,
        size: Size::LARGE,
    );

    expect(
        $image,
    )->toBeInstanceOf(ResponseContract::class);
})->with('authors');
