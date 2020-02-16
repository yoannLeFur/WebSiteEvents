<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216182509 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE creations ADD events_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE creations ADD CONSTRAINT FK_4C3194AB9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id)');
        $this->addSql('CREATE INDEX IDX_4C3194AB9D6A1065 ON creations (events_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE creations DROP FOREIGN KEY FK_4C3194AB9D6A1065');
        $this->addSql('DROP INDEX IDX_4C3194AB9D6A1065 ON creations');
        $this->addSql('ALTER TABLE creations DROP events_id');
    }
}
