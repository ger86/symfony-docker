<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230801131916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add test data';
    }

    public function up(Schema $schema): void
    {

        $this->addSql('INSERT INTO `ranges` values (1, 444, 434434)');

        foreach ($this->testData() as $ranges) {
            $this->addSql('INSERT INTO `ranges` (min, max) values (:min, :max)',
                ['min' => $ranges['min'], 'max' => $ranges['max']],
                [\PDO::PARAM_INT, \PDO::PARAM_INT]
            );
        }

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DELETE FROM `ranges`');
    }

    private function testData(): array
    {
        $csv = array_map("str_getcsv", file(__DIR__ . "/test_data.csv", FILE_SKIP_EMPTY_LINES));
        $keys = array_shift($csv);

        foreach ($csv as $i => $row) {
            $csv[$i] = array_combine($keys, $row);
        }
        return $csv;
    }
}
