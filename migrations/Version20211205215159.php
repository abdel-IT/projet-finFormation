<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211205215159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom_classe VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, parent_id INT DEFAULT NULL, prenom VARCHAR(50) NOT NULL, date_naissance_at DATE NOT NULL, date_inscription_at DATETIME NOT NULL, foto VARCHAR(50) NOT NULL, sexe TINYINT(1) DEFAULT NULL, INDEX IDX_ECA105F78F5EA509 (classe_id), INDEX IDX_ECA105F7727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_scolaire (id INT AUTO_INCREMENT NOT NULL, nom_niveau_scolaire VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, nom_famille VARCHAR(50) NOT NULL, prenom_pere VARCHAR(50) NOT NULL, nom_famille_mere VARCHAR(50) NOT NULL, prenom_mere VARCHAR(50) NOT NULL, telephone VARCHAR(15) NOT NULL, email VARCHAR(255) NOT NULL, gsm_pere VARCHAR(15) NOT NULL, gsm_mere VARCHAR(15) NOT NULL, rue VARCHAR(100) NOT NULL, numero INT NOT NULL, code_postal VARCHAR(4) NOT NULL, pays VARCHAR(255) NOT NULL, date_creation_at DATETIME NOT NULL, total_paiement SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7727ACA70');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE niveau_scolaire');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE professeur');
    }
}
