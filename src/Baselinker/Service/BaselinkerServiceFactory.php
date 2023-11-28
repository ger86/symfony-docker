<?php

namespace App\Baselinker\Service;

use App\Baselinker\Configuration\ConfigurationService;
use App\Baselinker\Service\Allegro\BaselinkerAllegroService;
use App\Baselinker\Service\Amazon\BaselinkerAmazonService;

class BaselinkerServiceFactory
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function createService(string $platform): BaselinkerServiceInterface
    {
        switch ($platform) {
            case 'allegro':
                return new BaselinkerAllegroService($this->apiKey);
            case 'amazon':
                return new BaselinkerAmazonService($this->apiKey);
            default:
                throw new \InvalidArgumentException('Invalid platform');
        }
    }
}
