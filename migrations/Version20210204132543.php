<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204132543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters (id INT AUTO_INCREMENT NOT NULL, race_id INT DEFAULT NULL, user_id INT DEFAULT NULL, groupe_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, age INT NOT NULL, creation_date DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, experience INT DEFAULT NULL, INDEX IDX_3A29410E6E59D40D (race_id), INDEX IDX_3A29410EA76ED395 (user_id), INDEX IDX_3A29410E7A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characters_character_class (characters_id INT NOT NULL, character_class_id INT NOT NULL, INDEX IDX_63C543BEC70F0E28 (characters_id), INDEX IDX_63C543BEB201E281 (character_class_id), PRIMARY KEY(characters_id, character_class_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE d (id INT AUTO_INCREMENT NOT NULL, d_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_98DD4ACCC00A36A (d_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `group` (id INT AUTO_INCREMENT NOT NULL, name_group VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E6E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE characters ADD CONSTRAINT FK_3A29410E7A45358C FOREIGN KEY (groupe_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE characters_character_class ADD CONSTRAINT FK_63C543BEC70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characters_character_class ADD CONSTRAINT FK_63C543BEB201E281 FOREIGN KEY (character_class_id) REFERENCES character_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE d ADD CONSTRAINT FK_98DD4ACCC00A36A FOREIGN KEY (d_id) REFERENCES d (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters_character_class DROP FOREIGN KEY FK_63C543BEB201E281');
        $this->addSql('ALTER TABLE characters_character_class DROP FOREIGN KEY FK_63C543BEC70F0E28');
        $this->addSql('ALTER TABLE d DROP FOREIGN KEY FK_98DD4ACCC00A36A');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E7A45358C');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410E6E59D40D');
        $this->addSql('ALTER TABLE characters DROP FOREIGN KEY FK_3A29410EA76ED395');
        $this->addSql('DROP TABLE character_class');
        $this->addSql('DROP TABLE characters');
        $this->addSql('DROP TABLE characters_character_class');
        $this->addSql('DROP TABLE d');
        $this->addSql('DROP TABLE `group`');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE user');
    }
}
