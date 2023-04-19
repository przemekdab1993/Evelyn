<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407070013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment DROP user_name');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C7E3C61F9 ON comment (owner_id)');
        $this->addSql('ALTER TABLE "user" ALTER password SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C7E3C61F9');
        $this->addSql('DROP INDEX IDX_9474526C7E3C61F9');
        $this->addSql('ALTER TABLE comment ADD user_name TEXT NOT NULL');
        $this->addSql('ALTER TABLE comment DROP owner_id');
        $this->addSql('ALTER TABLE "user" ALTER password DROP NOT NULL');
    }
}
