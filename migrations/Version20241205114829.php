<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205114829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tournoi_participant');
        $this->addSql('ALTER TABLE participant CHANGE email email VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE tournoi ADD participants VARCHAR(255) DEFAULT NULL, ADD nb_participants INT NOT NULL');
        $this->addSql('ALTER TABLE tournoi ADD CONSTRAINT FK_18AFD9DFBCF5E72D FOREIGN KEY (categorie_id) REFERENCES cat_tournois (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tournoi_participant (tournoi_id INT NOT NULL, participant_id INT NOT NULL, INDEX IDX_9C5314799D1C3019 (participant_id), INDEX IDX_9C531479F607770A (tournoi_id), PRIMARY KEY(tournoi_id, participant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE participant CHANGE email email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE tournoi DROP FOREIGN KEY FK_18AFD9DFBCF5E72D');
        $this->addSql('ALTER TABLE tournoi DROP participants, DROP nb_participants');
    }
}
