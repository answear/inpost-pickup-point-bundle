<?php

declare(strict_types=1);

namespace Answear\InpostBundle;

class ConfigProvider
{
    private const BASE_URL = 'https://api-shipx-pl.easypack24.net/';
    private const API_VERSION = 'v1';

    public function __construct(
        public readonly string $baseUrl = self::BASE_URL,
        public readonly string $apiVersion = self::API_VERSION,
    ) {
    }
}
