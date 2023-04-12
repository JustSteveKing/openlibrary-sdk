<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\Resources;

use JsonException;
use JustSteveKing\OpenLibrary\Concerns\CanAccessSdk;
use JustSteveKing\OpenLibrary\DataObjects\Author;
use JustSteveKing\OpenLibrary\Enums\Size;
use JustSteveKing\OpenLibrary\Exceptions\FailedToFetchAuthor;
use JustSteveKing\OpenLibrary\Exceptions\FailedToFetchAuthorWorks;
use JustSteveKing\OpenLibrary\Factories\AuthorFactory;
use JustSteveKing\Tools\Contracts\Http\ResponseContract;
use JustSteveKing\Tools\Contracts\SDK\ResourceContract;
use JustSteveKing\Tools\Http\Enums\Method;
use JustSteveKing\Tools\Http\Request;
use JustSteveKing\Tools\Http\Response;
use Throwable;

final class AuthorResource implements ResourceContract
{
    use CanAccessSdk;

    /**
     * @param string $identifier The identifier for the Author.
     * @return Author
     * @throws FailedToFetchAuthor
     * @throws JsonException
     */
    public function fetch(string $identifier): Author
    {
        try {
            $response = $this->sdk()->client()->sendRequest(
                request: (new Request(
                    method: Method::GET,
                    uri: "https://openlibrary.org/authors/{$identifier}.json",
                ))->toPsrRequest(),
            );
        } catch (Throwable $exception) {
            throw new FailedToFetchAuthor(
                message: "Failed to fetch author with identifier [{$identifier}].",
                previous: $exception,
            );
        }

        return AuthorFactory::make(
            data: Response::fromPsrResponse(
                response: $response,
            )->json(),
        );
    }

    /**
     * @param string $identifier The identifier for the Author.
     * @return array
     * @throws FailedToFetchAuthorWorks|JsonException
     */
    public function works(string $identifier): array
    {
        try {
            $response = $this->sdk()->client()->sendRequest(
                request: (new Request(
                    method: Method::GET,
                    uri: "https://openlibrary.org/authors/{$identifier}/works.json",
                ))->toPsrRequest(),
            );
        } catch (Throwable $exception) {
            throw new FailedToFetchAuthorWorks(
                message: "Failed to fetch works for author with identifier [{$identifier}].",
                previous: $exception,
            );
        }

        return Response::fromPsrResponse(
            response: $response,
        )->json();
    }

    /**
     * @param string $identifier The identifier of the Author.
     * @param Size $size The Size of the image to return.
     * @return ResponseContract
     * @throws FailedToFetchAuthorWorks
     * @throws JsonException
     */
    public function image(string $identifier, Size $size): ResponseContract
    {
        try {
            $response = $this->sdk()->client()->sendRequest(
                request: (new Request(
                    method: Method::GET,
                    uri: "https://covers.openlibrary.org/a/olid/{$identifier}-{$size->value}.jpg",
                ))->toPsrRequest(),
            );
        } catch (Throwable $exception) {
            throw new FailedToFetchAuthorWorks(
                message: "Failed to fetch works for author with identifier [{$identifier}].",
                previous: $exception,
            );
        }

        return Response::fromPsrResponse(
            response: $response,
        );
    }
}
