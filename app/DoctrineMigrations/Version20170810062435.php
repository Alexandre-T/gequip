<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170810062435 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_status CHANGE initial initial TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'Is it the initial status\', CHANGE discarded discarded TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'Is it a discarded status\', CHANGE managed managed TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'is it subject to calendar management\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_status CHANGE initial initial TINYINT(1) DEFAULT \'0\' COMMENT \'Is it the initial status\', CHANGE discarded discarded TINYINT(1) DEFAULT \'0\' COMMENT \'Is it a discarded status\', CHANGE managed managed TINYINT(1) DEFAULT \'0\' COMMENT \'is it subject to calendar management\'');
    }
}
