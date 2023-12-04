<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204112344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart ADD ctoyid_id INT NOT NULL, ADD cuserid_id INT NOT NULL, ADD cquantity INT NOT NULL');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B743483FEA FOREIGN KEY (ctoyid_id) REFERENCES toys (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B767B3612E FOREIGN KEY (cuserid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BA388B743483FEA ON cart (ctoyid_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA388B767B3612E ON cart (cuserid_id)');
        $this->addSql('ALTER TABLE toys DROP FOREIGN KEY FK_B16386F31AD5CDBF');
        $this->addSql('DROP INDEX IDX_B16386F31AD5CDBF ON toys');
        $this->addSql('ALTER TABLE toys DROP cart_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B743483FEA');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B767B3612E');
        $this->addSql('DROP INDEX IDX_BA388B743483FEA ON cart');
        $this->addSql('DROP INDEX UNIQ_BA388B767B3612E ON cart');
        $this->addSql('ALTER TABLE cart DROP ctoyid_id, DROP cuserid_id, DROP cquantity');
        $this->addSql('ALTER TABLE toys ADD cart_id INT NOT NULL');
        $this->addSql('ALTER TABLE toys ADD CONSTRAINT FK_B16386F31AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_B16386F31AD5CDBF ON toys (cart_id)');
    }
}
