<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201101103724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__characters AS SELECT id, lastname, firstname, age, creation_date, description FROM characters');
        $this->addSql('DROP TABLE characters');
        $this->addSql('CREATE TABLE characters (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, race_id INTEGER DEFAULT NULL, lastname VARCHAR(255) NOT NULL COLLATE BINARY, firstname VARCHAR(255) NOT NULL COLLATE BINARY, age INTEGER NOT NULL, creation_date DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_3A29410E6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO characters (id, lastname, firstname, age, creation_date, description) SELECT id, lastname, firstname, age, creation_date, description FROM __temp__characters');
        $this->addSql('DROP TABLE __temp__characters');
        $this->addSql('CREATE INDEX IDX_3A29410E6E59D40D ON characters (race_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_3A29410E6E59D40D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__characters AS SELECT id, lastname, firstname, age, creation_date, description FROM characters');
        $this->addSql('DROP TABLE characters');
        $this->addSql('CREATE TABLE characters (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, age INTEGER NOT NULL, creation_date DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO characters (id, lastname, firstname, age, creation_date, description) SELECT id, lastname, firstname, age, creation_date, description FROM __temp__characters');
        $this->addSql('DROP TABLE __temp__characters');
    }
}
