<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Response;

use Webmozart\Assert\Assert;

class ErrorResponse
{
    public string $message;
    public string $id;
    public int $code;

    public function __construct(
        string $message,
        string $id,
        int $code
    ) {
        $this->message = $message;
        $this->id = $id;
        $this->code = $code;
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

        return new self(
            $response['error'],
            $response['key'],
            (int) $response['status']
        );
    }
}
