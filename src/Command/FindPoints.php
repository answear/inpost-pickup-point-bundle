<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Command;

use Answear\InpostBundle\Client\Client;
use Answear\InpostBundle\Request\FindPointsRequest;
use Answear\InpostBundle\Response\FindPointsResponse;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;

class FindPoints extends AbstractCommand
{
    private Client $client;

    public function __construct(
        Client $client,
    ) {
        $this->client = $client;
    }

    public function findPoints(FindPointsRequest $request): FindPointsResponse
    {
        $httpRequest = new HttpRequest(
            $request->getMethod(),
            new Uri($request->getRequestUrl()),
            [
                'Content-Type' => 'application/json',
            ],
        );

        $response = $this->client->request($httpRequest);

        $body = $this->getBody($response);

        return FindPointsResponse::fromArray($body);
    }
}
