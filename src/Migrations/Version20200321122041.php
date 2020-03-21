<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321122041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agence CHANGE updated_at updated_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE background CHANGE updated_at updated_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE creations ADD updated_date DATETIME NOT NULL, CHANGE filename filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE galerie ADD updated_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE events ADD updated_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE images CHANGE updated_at updated_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE partners ADD updated_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE users ADD updated_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE agence CHANGE updated_date updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE background CHANGE updated_date updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE creations DROP updated_date, CHANGE filename filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE events DROP updated_date');
        $this->addSql('ALTER TABLE galerie DROP updated_date');
        $this->addSql('ALTER TABLE images CHANGE updated_date updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE partners DROP updated_date');
        $this->addSql('ALTER TABLE users DROP updated_date');
    }
}
