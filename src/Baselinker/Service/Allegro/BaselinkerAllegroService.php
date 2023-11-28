<?php

namespace App\Baselinker\Service\Allegro;

use App\Baselinker\Service\BaselinkerServiceInterface;

class BaselinkerAllegroService implements BaselinkerServiceInterface
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function fetchOrders(): array
    {
        // Implementacja pobierania zamówień z Allegro
        // ...
        return [];
    }
}
