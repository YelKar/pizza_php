<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624092917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<sql
            ALTER TABLE product RENAME COLUMN `description` TO `ingredients`;
            ALTER TABLE product ADD COLUMN `description` TEXT;
        sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<sql
            ALTER TABLE product DROP COLUMN `description`;
            ALTER TABLE product RENAME COLUMN `ingredients` TO `description`;
        sql);
    }
}
