<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\Factories;

use Carbon\Carbon;
use JustSteveKing\OpenLibrary\DataObjects\Author;

final class AuthorFactory
{
    public static function make(array $data): Author
    {
        return new Author(
            title: $data['title'],
            wikipedia: $data['wikipedia'],
            name: $data['personal_name'],
            bio: $data['bio'],
            birth: Carbon::parse(
                time: $data['birth_date'],
            ),
            death: $data['death_date']
                ? Carbon::parse(
                    time: $data['death_date'],
                ) : null,
            photos: $data['photos'],
            records: $data['source_records'],
            ids: $data['remote_ids'],
            links: $data['links'],
        );
    }
}
