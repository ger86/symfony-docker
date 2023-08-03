<?php

namespace App\Tests\unit;

use App\Services\RangeService;
use Doctrine\DBAL\Connection;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class RangeServiceTest extends TestCase
{
    use m\Adapter\Phpunit\MockeryPHPUnitIntegration;

    public function testUseDBForDeterminingId(): void
    {
        $number = 1240840200000000662;

        $db = M::mock(Connection::class);
        $db
            ->shouldReceive('fetchOne')
            ->withArgs(['select * from `ranges` where :num between min and max', ['num' => $number]])
            ->andReturn(1)
            ->once();

        $service = new RangeService($db);

        self::assertSame(1, $service->rangeIdByNumber($number));
    }

    public function testAddZerosIfNumberIsTooSmall(): void
    {
        $number = 1230000000000000000;

        $db = M::mock(Connection::class);
        $db
            ->shouldReceive('fetchOne')
            ->withArgs(['select * from `ranges` where :num between min and max', ['num' => $number]])
            ->andReturn(1)
            ->once();

        $service = new RangeService($db);
        $service->rangeIdByNumber(123);
    }
}
