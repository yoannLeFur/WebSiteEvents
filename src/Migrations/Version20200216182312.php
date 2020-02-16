<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216182312 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_events (partners_id INT NOT NULL, events_id INT NOT NULL, INDEX IDX_C387A4CDBDE7F1C6 (partners_id), INDEX IDX_C387A4CD9D6A1065 (events_id), PRIMARY KEY(partners_id, events_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners_creations (partners_id INT NOT NULL, creations_id INT NOT NULL, INDEX IDX_97DA2B40BDE7F1C6 (partners_id), INDEX IDX_97DA2B40F79F38D9 (creations_id), PRIMARY KEY(partners_id, creations_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partners_events ADD CONSTRAINT FK_C387A4CDBDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_events ADD CONSTRAINT FK_C387A4CD9D6A1065 FOREIGN KEY (events_id) REFERENCES events (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_creations ADD CONSTRAINT FK_97DA2B40BDE7F1C6 FOREIGN KEY (partners_id) REFERENCES partners (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partners_creations ADD CONSTRAINT FK_97DA2B40F79F38D9 FOREIGN KEY (creations_id) REFERENCES creations (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE partners_events DROP FOREIGN KEY FK_C387A4CDBDE7F1C6');
        $this->addSql('ALTER TABLE partners_creations DROP FOREIGN KEY FK_97DA2B40BDE7F1C6');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE partners_events');
        $this->addSql('DROP TABLE partners_creations');
    }
}
