<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803174914 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family ADD slug VARCHAR(255) NOT NULL, CHANGE id id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la famille\', CHANGE parent_tree parent_tree INT DEFAULT NULL COMMENT \'Identifiant de la famille\', CHANGE root_tree root_tree INT DEFAULT NULL COMMENT \'Identifiant de la famille\', CHANGE name name VARCHAR(32) NOT NULL COMMENT \'Family path\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family DROP slug, CHANGE id id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la family\', CHANGE parent_tree parent_tree INT DEFAULT NULL COMMENT \'Identifiant de la family\', CHANGE root_tree root_tree INT DEFAULT NULL COMMENT \'Identifiant de la family\', CHANGE name name VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci COMMENT \'Nom de la family\'');
    }
}
