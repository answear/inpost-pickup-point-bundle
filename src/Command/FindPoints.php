<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Command;

use Answear\InpostBundle\Client\Client;
use Answear\InpostBundle\Client\Serializer;
use Answear\InpostBundle\ConfigProvider;
use Answear\InpostBundle\Request\FindPointsRequest;
use Answear\InpostBundle\Response\FindPointsResponse;
use GuzzleHttp\Psr7\Request as HttpRequest;
use GuzzleHttp\Psr7\Uri;

class FindPoints extends AbstractCommand
{
    private Client $client;
    private Serializer $serializer;

    public function __construct(
        private readonly ConfigProvider $configProvider,
        Client $client,
        Serializer $serializer,
    ) {
        $this->client = $client;
        $this->serializer = $serializer;
    }

    public function findPoints(FindPointsRequest $request): FindPointsResponse
    {
        $httpRequest = new HttpRequest(
            $request->getMethod(),
            new Uri($this->configProvider->apiVersion . $request->getRequestUrl()),
            [
                'Content-type' => 'application/json',
            ],
            $this->serializer->serialize($request)
        );

        $response = $this->client->request($httpRequest);

        $body = $this->getBody($response);

        return FindPointsResponse::fromArray($body);
    }
}
