<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170811180156 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E16F4F95B');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E3D8E604F');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E16F4F95B FOREIGN KEY (root) REFERENCES te_family (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E3D8E604F FOREIGN KEY (parent) REFERENCES te_family (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB916F4F95B');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB93D8E604F');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB916F4F95B FOREIGN KEY (root) REFERENCES te_service (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB93D8E604F FOREIGN KEY (parent) REFERENCES te_service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE te_criticity CHANGE name name VARCHAR(16) NOT NULL COMMENT \'Name of the criticity\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_criticity CHANGE name name VARCHAR(16) NOT NULL COLLATE utf8_unicode_ci COMMENT \'Name of the criticity\'');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E3D8E604F');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E16F4F95B');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E3D8E604F FOREIGN KEY (parent) REFERENCES te_family (id)');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E16F4F95B FOREIGN KEY (root) REFERENCES te_family (id)');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB93D8E604F');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB916F4F95B');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB93D8E604F FOREIGN KEY (parent) REFERENCES te_service (id)');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB916F4F95B FOREIGN KEY (root) REFERENCES te_service (id)');
    }
}
