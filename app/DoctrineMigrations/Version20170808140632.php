<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170808140632 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family ADD updater INT DEFAULT NULL, ADD updated DATETIME DEFAULT NULL COMMENT \'Last update datetime\', CHANGE id id INT AUTO_INCREMENT NOT NULL COMMENT \'Family ID\', CHANGE parent_tree parent_tree INT DEFAULT NULL COMMENT \'Family ID\', CHANGE root_tree root_tree INT DEFAULT NULL COMMENT \'Family ID\', CHANGE left_tree left_tree INT NOT NULL COMMENT \'Left born of the tree\', CHANGE right_tree right_tree INT NOT NULL COMMENT \'Right born of the tree\', CHANGE level_tree level_tree INT NOT NULL COMMENT \'Level on the tree\', CHANGE name name VARCHAR(32) NOT NULL COMMENT \'Family name\', CHANGE created created DATETIME NOT NULL COMMENT \'Creation date\', CHANGE slug slug VARCHAR(255) NOT NULL COMMENT \'Name sluggified\'');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
        $this->addSql('CREATE INDEX IDX_12F4310E324F23A6 ON te_family (updater)');
        $this->addSql('ALTER TABLE te_user CHANGE presentation presentation LONGTEXT DEFAULT NULL COMMENT \'User presentation (markdown format)\', CHANGE created created DATETIME NOT NULL COMMENT \'Creation time of user\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E324F23A6');
        $this->addSql('DROP INDEX IDX_12F4310E324F23A6 ON te_family');
        $this->addSql('ALTER TABLE te_family DROP updater, DROP updated, CHANGE id id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la famille\', CHANGE parent_tree parent_tree INT DEFAULT NULL COMMENT \'Identifiant de la famille\', CHANGE root_tree root_tree INT DEFAULT NULL COMMENT \'Identifiant de la famille\', CHANGE left_tree left_tree INT NOT NULL COMMENT \'Borne gauche de l\'\'arbre\', CHANGE right_tree right_tree INT NOT NULL COMMENT \'Borne droite de l\'\'arbre\', CHANGE level_tree level_tree INT NOT NULL COMMENT \'Niveau de l\'\'arbre\', CHANGE name name VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci COMMENT \'Family path\', CHANGE slug slug VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, CHANGE created created DATETIME NOT NULL COMMENT \'Date de création automatique\'');
        $this->addSql('ALTER TABLE te_user CHANGE presentation presentation LONGTEXT DEFAULT NULL COLLATE utf8_unicode_ci COMMENT \'Description Markdown de l\'\'utilisateur\', CHANGE created created DATETIME NOT NULL COMMENT \'Date de création automatique\'');
    }
}
