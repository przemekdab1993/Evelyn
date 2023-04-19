<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204212302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD doc_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C895648BC FOREIGN KEY (doc_id) REFERENCES doc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C895648BC ON comment (doc_id)');
        $this->addSql('ALTER TABLE doc_rating DROP CONSTRAINT fk_5aee3b8e10adf301');
        $this->addSql('DROP INDEX uniq_5aee3b8e10adf301');
        $this->addSql('ALTER TABLE doc_rating ALTER good DROP DEFAULT');
        $this->addSql('ALTER TABLE doc_rating RENAME COLUMN doc_id_id TO doc_id');
        $this->addSql('ALTER TABLE doc_rating ADD CONSTRAINT FK_5AEE3B8E895648BC FOREIGN KEY (doc_id) REFERENCES doc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5AEE3B8E895648BC ON doc_rating (doc_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C895648BC');
        $this->addSql('DROP INDEX IDX_9474526C895648BC');
        $this->addSql('ALTER TABLE comment DROP doc_id');
        $this->addSql('ALTER TABLE doc_rating DROP CONSTRAINT FK_5AEE3B8E895648BC');
        $this->addSql('DROP INDEX UNIQ_5AEE3B8E895648BC');
        $this->addSql('ALTER TABLE doc_rating ALTER good SET DEFAULT 0');
        $this->addSql('ALTER TABLE doc_rating RENAME COLUMN doc_id TO doc_id_id');
        $this->addSql('ALTER TABLE doc_rating ADD CONSTRAINT fk_5aee3b8e10adf301 FOREIGN KEY (doc_id_id) REFERENCES doc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_5aee3b8e10adf301 ON doc_rating (doc_id_id)');
    }
}
