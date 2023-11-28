<?php

namespace App\Message;

class BaselinkerOrderFetchMessage
{
    private string $platform;

    public function __construct(string $platform)
    {
        $this->platform = $platform;
    }

    public function getPlatform(): string
    {
        return $this->platform;
    }
}
