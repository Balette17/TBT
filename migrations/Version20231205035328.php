<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231205035328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, cart_item_id INT NOT NULL, ctoyid_id INT NOT NULL, cquantity INT NOT NULL, INDEX IDX_BA388B7E9B59A59 (cart_item_id), INDEX IDX_BA388B743483FEA (ctoyid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, catid VARCHAR(50) NOT NULL, catname VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE toys (id INT AUTO_INCREMENT NOT NULL, cat_id INT NOT NULL, tname VARCHAR(100) NOT NULL, tdesc VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, tquan SMALLINT NOT NULL, image VARCHAR(255) DEFAULT NULL, created DATETIME NOT NULL, INDEX IDX_B16386F3E6ADA943 (cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, uid VARCHAR(50) NOT NULL, username VARCHAR(50) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7E9B59A59 FOREIGN KEY (cart_item_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B743483FEA FOREIGN KEY (ctoyid_id) REFERENCES toys (id)');
        $this->addSql('ALTER TABLE toys ADD CONSTRAINT FK_B16386F3E6ADA943 FOREIGN KEY (cat_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7E9B59A59');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B743483FEA');
        $this->addSql('ALTER TABLE toys DROP FOREIGN KEY FK_B16386F3E6ADA943');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE toys');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
