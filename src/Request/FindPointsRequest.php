<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Request;

class FindPointsRequest implements Request
{
    private const ENDPOINT = '/points';
    private const HTTP_METHOD = 'GET';

    private array $searchCriteria;

    public function __construct(array $criteria = [])
    {
        $this->searchCriteria = $criteria;
    }

    public function getRequestUrl(): string
    {
        if (count($this->searchCriteria) > 0) {
            return static::ENDPOINT . '?' . http_build_query($this->searchCriteria);
        }

        return static::ENDPOINT;
    }

    public function getMethod(): string
    {
        return static::HTTP_METHOD;
    }
}
