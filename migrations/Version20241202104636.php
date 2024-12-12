<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241202104636 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cat_tournois (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tournoi ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES cat_tournois (id)');
        $this->addSql('CREATE INDEX IDX_18AFD9DFBCF5E72D ON tournoi (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cat_tournois');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFBCF5E72D');
        $this->addSql('DROP INDEX IDX_18AFD9DFBCF5E72D ON tournoi');
        $this->addSql('ALTER TABLE tournoi DROP categorie_id');
    }
}
