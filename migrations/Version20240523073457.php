<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240523073457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, room VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE Room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(60) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, north VARCHAR(40) DEFAULT NULL, south VARCHAR(40) DEFAULT NULL, east VARCHAR(40) DEFAULT NULL, west VARCHAR(40) DEFAULT NULL, inspect CLOB NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Item');
        $this->addSql('DROP TABLE Room');
    }
}
