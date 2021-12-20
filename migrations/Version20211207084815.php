<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207084815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe ADD niveau_scolaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96C3584218 FOREIGN KEY (niveau_scolaire_id) REFERENCES niveau_scolaire (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96C3584218 ON classe (niveau_scolaire_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96C3584218');
        $this->addSql('DROP INDEX IDX_8F87BF96C3584218 ON classe');
        $this->addSql('ALTER TABLE classe DROP niveau_scolaire_id');
    }
}
