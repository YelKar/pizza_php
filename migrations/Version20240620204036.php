<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620204036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<sql
            CREATE TABLE pizza(
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(255) NOT NULL,
                description TEXT,
                prise INT NOT NULL,
                image VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            );
        sql);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<sql
            DROP TABLE pizza;
        sql);
    }
}
