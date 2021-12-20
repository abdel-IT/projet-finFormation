<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211212233449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, niveau_scolaire_id INT DEFAULT NULL, nom_classe VARCHAR(50) NOT NULL, INDEX IDX_8F87BF96C3584218 (niveau_scolaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, parent_id INT DEFAULT NULL, prenom VARCHAR(50) NOT NULL, date_naissance_at DATE NOT NULL, date_inscription_at DATETIME NOT NULL, foto VARCHAR(255) DEFAULT NULL, sexe TINYINT(1) DEFAULT NULL, image VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_ECA105F78F5EA509 (classe_id), INDEX IDX_ECA105F7727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau_scolaire (id INT AUTO_INCREMENT NOT NULL, nom_niveau_scolaire VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paiement (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, date_paiement DATETIME NOT NULL, montant SMALLINT NOT NULL, INDEX IDX_B1DC7A1E727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parents (id INT AUTO_INCREMENT NOT NULL, nom_famille VARCHAR(50) NOT NULL, prenom_pere VARCHAR(50) NOT NULL, nom_famille_mere VARCHAR(50) NOT NULL, prenom_mere VARCHAR(50) NOT NULL, telephone VARCHAR(15) NOT NULL, email VARCHAR(255) NOT NULL, gsm_pere VARCHAR(15) NOT NULL, gsm_mere VARCHAR(15) NOT NULL, rue VARCHAR(100) NOT NULL, numero INT NOT NULL, code_postal VARCHAR(4) NOT NULL, pays VARCHAR(255) NOT NULL, date_creation_at DATETIME NOT NULL, total_paiement SMALLINT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professeur_classe (professeur_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_38ABBDC6BAB22EE9 (professeur_id), INDEX IDX_38ABBDC68F5EA509 (classe_id), PRIMARY KEY(professeur_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96C3584218 FOREIGN KEY (niveau_scolaire_id) REFERENCES niveau_scolaire (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F78F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE paiement ADD CONSTRAINT FK_B1DC7A1E727ACA70 FOREIGN KEY (parent_id) REFERENCES parents (id)');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC6BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE professeur_classe ADD CONSTRAINT FK_38ABBDC68F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F78F5EA509');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC68F5EA509');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96C3584218');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7727ACA70');
        $this->addSql('ALTER TABLE paiement DROP FOREIGN KEY FK_B1DC7A1E727ACA70');
        $this->addSql('ALTER TABLE professeur_classe DROP FOREIGN KEY FK_38ABBDC6BAB22EE9');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE niveau_scolaire');
        $this->addSql('DROP TABLE paiement');
        $this->addSql('DROP TABLE parents');
        $this->addSql('DROP TABLE professeur');
        $this->addSql('DROP TABLE professeur_classe');
    }
}
