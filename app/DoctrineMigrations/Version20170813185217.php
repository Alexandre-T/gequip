<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170813185217 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E6CE835E237E06 ON te_axe (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E6CE8377153098 ON te_axe (code)');
        $this->addSql('ALTER TABLE te_criticity CHANGE name name VARCHAR(16) NOT NULL COMMENT \'Name of the criticity\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_70E6CE835E237E06 ON te_axe');
        $this->addSql('DROP INDEX UNIQ_70E6CE8377153098 ON te_axe');
        $this->addSql('ALTER TABLE te_criticity CHANGE name name VARCHAR(16) NOT NULL COLLATE utf8_unicode_ci COMMENT \'Name of the criticity\'');
    }
}
