<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204112758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B767B3612E');
        $this->addSql('DROP INDEX UNIQ_BA388B767B3612E ON cart');
        $this->addSql('ALTER TABLE cart DROP cuserid_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD cuserid_id INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B767B3612E FOREIGN KEY (cuserid_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B767B3612E ON cart (cuserid_id)');
    }
}
