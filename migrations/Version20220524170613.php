<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524170613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE beneficiaire (id INT AUTO_INCREMENT NOT NULL, transfert_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_B140D8023C9C4BAD (transfert_id), INDEX IDX_B140D802F2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, adresse VARCHAR(255) NOT NULL, rib BIGINT NOT NULL, solde DOUBLE PRECISION NOT NULL, intitule VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, beneficiaire_id INT DEFAULT NULL, compte_id INT DEFAULT NULL, text VARCHAR(255) NOT NULL, date_envoie DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, reference BIGINT NOT NULL, INDEX IDX_B6BD307F5AF81F68 (beneficiaire_id), INDEX IDX_B6BD307FF2C56620 (compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfert (id INT AUTO_INCREMENT NOT NULL, transfert_id INT DEFAULT NULL, reference BIGINT NOT NULL, montant INT NOT NULL, date_validation DATE NOT NULL, INDEX IDX_1E4EACBB3C9C4BAD (transfert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE beneficiaire ADD CONSTRAINT FK_B140D8023C9C4BAD FOREIGN KEY (transfert_id) REFERENCES transfert (id)');
        $this->addSql('ALTER TABLE beneficiaire ADD CONSTRAINT FK_B140D802F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5AF81F68 FOREIGN KEY (beneficiaire_id) REFERENCES beneficiaire (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB3C9C4BAD FOREIGN KEY (transfert_id) REFERENCES compte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5AF81F68');
        $this->addSql('ALTER TABLE beneficiaire DROP FOREIGN KEY FK_B140D802F2C56620');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF2C56620');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB3C9C4BAD');
        $this->addSql('ALTER TABLE beneficiaire DROP FOREIGN KEY FK_B140D8023C9C4BAD');
        $this->addSql('DROP TABLE beneficiaire');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE transfert');
    }
}
