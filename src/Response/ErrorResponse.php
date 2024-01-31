<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response;

use Webmozart\Assert\Assert;

class ErrorResponse
{
    public function __construct(
        public string $message,
        public string $id,
        public int $code,
    ) {
    }

    public static function isErrorResponse(array $response): bool
    {
        return isset($response['error']);
    }

    public static function fromArray(array $response): self
    {
        if (!static::isErrorResponse($response)) {
            throw new \RuntimeException('Cannot create ErrorResponse');
        }

        Assert::keyExists($response, 'error');
        Assert::keyExists($response, 'key');
        Assert::keyExists($response, 'status');
        Assert::integer($response['status']);

        return new self(
            $response['error'],
            $response['key'],
            $response['status']
        );
    }
}
