<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201231095106 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, race_id INT DEFAULT NULL, user_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, age INT NOT NULL, creation_date DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_3A29410E6E59D40D (race_id), INDEX IDX_3A29410EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE d (id INT AUTO_INCREMENT NOT NULL, d_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_98DD4ACCC00A36A (d_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE d ADD CONSTRAINT FK_98DD4ACCC00A36A FOREIGN KEY (d_id) REFERENCES d (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE d DROP FOREIGN KEY FK_98DD4ACCC00A36A');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E6E59D40D');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EA76ED395');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE d');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE user');
    }
}
