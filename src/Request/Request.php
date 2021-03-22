<?php

declare(strict_types=1);

namespace Answear\InpostBundle\Request;

interface Request
{
    public function getEndpoint(): string;

    public function getMethod(): string;
}
