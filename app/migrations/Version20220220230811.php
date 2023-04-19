<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220220230811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE doc_tag (doc_id INT NOT NULL, tag_id INT NOT NULL, PRIMARY KEY(doc_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_AA0376FF895648BC ON doc_tag (doc_id)');
        $this->addSql('CREATE INDEX IDX_AA0376FFBAD26311 ON doc_tag (tag_id)');
        $this->addSql('ALTER TABLE doc_tag ADD CONSTRAINT FK_AA0376FF895648BC FOREIGN KEY (doc_id) REFERENCES doc (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE doc_tag ADD CONSTRAINT FK_AA0376FFBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE doc_tag');
    }
}
