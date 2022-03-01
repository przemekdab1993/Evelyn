<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220228212149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE doc_author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE doc_author (id INT NOT NULL, doc_id INT DEFAULT NULL, author_id INT DEFAULT NULL, add_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3FC8C564895648BC ON doc_author (doc_id)');
        $this->addSql('CREATE INDEX IDX_3FC8C564F675F31B ON doc_author (author_id)');
        $this->addSql('COMMENT ON COLUMN doc_author.add_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE doc_author ADD CONSTRAINT FK_3FC8C564895648BC FOREIGN KEY (doc_id) REFERENCES doc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doc_author ADD CONSTRAINT FK_3FC8C564F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE doc_author_id_seq CASCADE');
        $this->addSql('DROP TABLE doc_author');
    }
}
