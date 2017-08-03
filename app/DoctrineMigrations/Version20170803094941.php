<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803094941 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_famille ADD creator INT NOT NULL');
        $this->addSql('ALTER TABLE te_famille ADD CONSTRAINT FK_3FC54578BC06EA63 FOREIGN KEY (creator) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_3FC54578BC06EA63 ON te_famille (creator)');
        $this->addSql('ALTER TABLE utilisateur ADD presentation LONGTEXT DEFAULT NULL COMMENT \'Description Markdown de l\'\'utilisateur\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_famille DROP FOREIGN KEY FK_3FC54578BC06EA63');
        $this->addSql('DROP INDEX IDX_3FC54578BC06EA63 ON te_famille');
        $this->addSql('ALTER TABLE te_famille DROP creator');
        $this->addSql('ALTER TABLE utilisateur DROP presentation');
    }
}
