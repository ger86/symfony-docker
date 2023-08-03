<?php

namespace App\Services;

use Doctrine\DBAL\Connection;

class RangeService
{
    private const RANGE_LENGTH = 19;
    private Connection $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function rangeIdByNumber(int $number): int
    {
        return $this->db->fetchOne('select * from `ranges` where :num between min and max',
            ['num' => $this->prepareNumber($number)]
        );
    }

    private function prepareNumber(int $number): int
    {
        if (($length = strlen($number)) < self::RANGE_LENGTH) {
            $zerosToAdd = self::RANGE_LENGTH - $length;

            while ($zerosToAdd) {
                $number = $number . 0;
                $zerosToAdd--;
            }
        }

        return (int)$number;
    }
}
