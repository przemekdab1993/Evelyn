<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407074346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doc ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doc ADD CONSTRAINT FK_8641FD647E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8641FD647E3C61F9 ON doc (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE doc DROP CONSTRAINT FK_8641FD647E3C61F9');
        $this->addSql('DROP INDEX IDX_8641FD647E3C61F9');
        $this->addSql('ALTER TABLE doc DROP owner_id');
    }
}
