<?php

namespace App\Tests\integrations;

use App\Services\RangeService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FindRangeTest extends WebTestCase
{
    public function testServiceReturnsZeroIfNumberNotInTheRange(): void
    {
        $service = $this->getContainer()->get(RangeService::class);
        self::assertSame(0, $service->rangeIdByNumber(1));
    }

    public function testCanGetRangeId()
    {
        $service = $this->getContainer()->get(RangeService::class);
        self::assertSame(1, $service->rangeIdByNumber(1244470000000000001));
    }
}
