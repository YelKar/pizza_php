<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use phpDocumentor\Reflection\Types\This;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620212937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<sql
            ALTER TABLE product RENAME TO product;
        sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<sql
            ALTER TABLE product RENAME TO product;
        sql);
    }
}
