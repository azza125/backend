<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524171348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE beneficiaire DROP FOREIGN KEY FK_B140D802F2C56620');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF2C56620');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB3C9C4BAD');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP INDEX IDX_B140D802F2C56620 ON beneficiaire');
        $this->addSql('ALTER TABLE beneficiaire DROP compte_id');
        $this->addSql('DROP INDEX IDX_B6BD307FF2C56620 ON message');
        $this->addSql('ALTER TABLE message DROP compte_id');
        $this->addSql('DROP INDEX IDX_1E4EACBB3C9C4BAD ON transfert');
        $this->addSql('ALTER TABLE transfert DROP transfert_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, telephone INT NOT NULL, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, rib BIGINT NOT NULL, solde DOUBLE PRECISION NOT NULL, intitule VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE beneficiaire ADD compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE beneficiaire ADD CONSTRAINT FK_B140D802F2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_B140D802F2C56620 ON beneficiaire (compte_id)');
        $this->addSql('ALTER TABLE message ADD compte_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FF2C56620 ON message (compte_id)');
        $this->addSql('ALTER TABLE transfert ADD transfert_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB3C9C4BAD FOREIGN KEY (transfert_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_1E4EACBB3C9C4BAD ON transfert (transfert_id)');
    }
}
