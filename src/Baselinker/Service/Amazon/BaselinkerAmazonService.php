<?php

namespace App\Baselinker\Service\Amazon;

use App\Baselinker\Service\BaselinkerServiceInterface;

class BaselinkerAmazonService implements BaselinkerServiceInterface
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function fetchOrders(): array
    {
        // Implementacja pobierania zamówień z Amazon
        // ...

        return [];
    }
}

