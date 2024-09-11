<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Client;

use Answear\InpostBundle\ConfigProvider;
use Answear\InpostBundle\Exception\ServiceUnavailableException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class Client
{
    private const CONNECTION_TIMEOUT = 10;
    private const TIMEOUT = 30;
    
    private ClientInterface $client;

    public function __construct(
        private readonly ConfigProvider $configProvider,
        ?ClientInterface $client = null,
    ) {
        $this->client = $client ?? new GuzzleClient(
            [
                'base_uri' => $this->configProvider->baseUrl,
                'timeout' => self::TIMEOUT,
                'connect_timeout' => self::CONNECTION_TIMEOUT
            ]
        );
    }

    public function request(Request $request): ResponseInterface
    {
        try {
            $response = $this->client->send($request);

            if ($response->getBody()->isSeekable()) {
                $response->getBody()->rewind();
            }
        } catch (GuzzleException $e) {
            throw new ServiceUnavailableException($e->getMessage(), $e->getCode(), $e);
        }

        return $response;
    }
}
