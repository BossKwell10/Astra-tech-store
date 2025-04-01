<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250328084317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE campagny ADD postal VARCHAR(255) DEFAULT NULL, DROP products, CHANGE services services VARCHAR(255) DEFAULT NULL, CHANGE contact contact VARCHAR(255) DEFAULT NULL, CHANGE mission address VARCHAR(255) DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE campagny ADD mission VARCHAR(255) DEFAULT NULL, ADD products JSON DEFAULT NULL, DROP address, DROP postal, CHANGE services services JSON DEFAULT NULL, CHANGE contact contact JSON DEFAULT NULL
        SQL);
    }
}
