<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118161506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, paiment_id INT DEFAULT NULL, nom_user VARCHAR(255) NOT NULL, prenom_user VARCHAR(255) NOT NULL, matricule VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, prix INT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, UNIQUE INDEX UNIQ_FE86641078789290 (paiment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE methode_paiment (id INT AUTO_INCREMENT NOT NULL, methode VARCHAR(255) NOT NULL, type_paiment VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641078789290 FOREIGN KEY (paiment_id) REFERENCES methode_paiment (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641078789290');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE methode_paiment');
    }
}
