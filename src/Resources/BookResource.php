<?php

declare(strict_types=1);

namespace JustSteveKing\OpenLibrary\Resources;

use JsonException;
use JustSteveKing\OpenLibrary\Concerns\CanAccessSdk;
use JustSteveKing\OpenLibrary\DataObjects\Work;
use JustSteveKing\OpenLibrary\Exceptions\FailedToFetchWork;
use JustSteveKing\OpenLibrary\Factories\WorkFactory;
use JustSteveKing\Tools\Contracts\SDK\ResourceContract;
use JustSteveKing\Tools\Http\Enums\Method;
use JustSteveKing\Tools\Http\Request;
use JustSteveKing\Tools\Http\Response;
use Throwable;

final class BookResource implements ResourceContract
{
    use CanAccessSdk;

    /**
     * @param string $identifier The Book to fetch.
     * @return Work
     * @throws FailedToFetchWork|JsonException
     */
    public function fetch(string $identifier): Work
    {
        try {
            $response = $this->sdk()->client()->sendRequest(
                request: (new Request(
                    method: Method::GET,
                    uri: "https://openlibrary.org/works/{$identifier}.json",
                ))->toPsrRequest(),
            );
        } catch (Throwable $exception) {
            throw new FailedToFetchWork(
                message: "Failed to fetch work for identifier: [{$identifier}].",
                previous: $exception,
            );
        }

        return WorkFactory::make(
            data: Response::fromPsrResponse(
                response: $response,
            )->json(),
        );
    }
}
