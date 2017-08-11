<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170811174019 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ext_log_entries (id INT AUTO_INCREMENT NOT NULL, action VARCHAR(8) NOT NULL, logged_at DATETIME NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', username VARCHAR(255) DEFAULT NULL, INDEX log_class_lookup_idx (object_class), INDEX log_date_lookup_idx (logged_at), INDEX log_user_lookup_idx (username), INDEX log_version_lookup_idx (object_id, object_class, version), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE te_criticity (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant of criticity\', creator INT NOT NULL, updater INT NOT NULL, name VARCHAR(16) NOT NULL COMMENT \'Name of the criticity\', intervention VARCHAR(8) NOT NULL COMMENT \'Intervention period\', recovery VARCHAR(8) NOT NULL COMMENT \'Recovery period\', created DATETIME NOT NULL COMMENT \'Creation datetime\', updated DATETIME NOT NULL COMMENT \'Update datetime\', working VARCHAR(8) DEFAULT NULL COMMENT \'Average working time target (cible MTBF)\', INDEX IDX_A83E3E22BC06EA63 (creator), INDEX IDX_A83E3E22324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Cricity of equipment\' ');
        $this->addSql('CREATE TABLE te_family (id INT AUTO_INCREMENT NOT NULL COMMENT \'Tree ID\', parent INT DEFAULT NULL COMMENT \'Tree ID\', root INT DEFAULT NULL COMMENT \'Tree ID\', creator INT NOT NULL, updater INT DEFAULT NULL, left_tree INT NOT NULL COMMENT \'Left born of the tree\', right_tree INT NOT NULL COMMENT \'Right born of the tree\', level_tree INT NOT NULL COMMENT \'Level on the tree\', name VARCHAR(32) NOT NULL COMMENT \'Node name\', slug VARCHAR(255) NOT NULL COMMENT \'Name sluggified\', created DATETIME NOT NULL COMMENT \'Creation date\', updated DATETIME DEFAULT NULL COMMENT \'Last update datetime\', INDEX IDX_12F4310E3D8E604F (parent), INDEX IDX_12F4310E16F4F95B (root), INDEX IDX_12F4310EBC06EA63 (creator), INDEX IDX_12F4310E324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Families of road equipments\' ');
        $this->addSql('CREATE TABLE te_service (id INT AUTO_INCREMENT NOT NULL COMMENT \'Tree ID\', parent INT DEFAULT NULL COMMENT \'Tree ID\', root INT DEFAULT NULL COMMENT \'Tree ID\', creator INT NOT NULL, updater INT DEFAULT NULL, left_tree INT NOT NULL COMMENT \'Left born of the tree\', right_tree INT NOT NULL COMMENT \'Right born of the tree\', level_tree INT NOT NULL COMMENT \'Level on the tree\', name VARCHAR(32) NOT NULL COMMENT \'Node name\', slug VARCHAR(255) NOT NULL COMMENT \'Name sluggified\', created DATETIME NOT NULL COMMENT \'Creation date\', updated DATETIME DEFAULT NULL COMMENT \'Last update datetime\', INDEX IDX_FA2B2DB93D8E604F (parent), INDEX IDX_FA2B2DB916F4F95B (root), INDEX IDX_FA2B2DB9BC06EA63 (creator), INDEX IDX_FA2B2DB9324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Service of the enterprise\' ');
        $this->addSql('CREATE TABLE te_status (id INT AUTO_INCREMENT NOT NULL COMMENT \'Status id\', creator INT NOT NULL, updater INT NOT NULL, created DATETIME NOT NULL COMMENT \'Creation date\', updated DATETIME DEFAULT NULL COMMENT \'Last update datetime\', name VARCHAR(16) NOT NULL COMMENT \'Status name\', initial TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'Is it the initial status\', discarded TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'Is it a discarded status\', managed TINYINT(1) DEFAULT \'0\' NOT NULL COMMENT \'is it subject to calendar management\', presentation LONGTEXT DEFAULT NULL COMMENT \'markdown presentation of text\', UNIQUE INDEX UNIQ_CC1275495E237E06 (name), INDEX IDX_CC127549BC06EA63 (creator), INDEX IDX_CC127549324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE te_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', presentation LONGTEXT DEFAULT NULL COMMENT \'User presentation (markdown format)\', created DATETIME NOT NULL COMMENT \'Creation time of user\', UNIQUE INDEX UNIQ_CBE6E4E092FC23A8 (username_canonical), UNIQUE INDEX UNIQ_CBE6E4E0A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_CBE6E4E0C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'User entity\' ');
        $this->addSql('ALTER TABLE te_criticity ADD CONSTRAINT FK_A83E3E22BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_criticity ADD CONSTRAINT FK_A83E3E22324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E3D8E604F FOREIGN KEY (parent) REFERENCES te_family (id)');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E16F4F95B FOREIGN KEY (root) REFERENCES te_family (id)');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310EBC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB93D8E604F FOREIGN KEY (parent) REFERENCES te_service (id)');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB916F4F95B FOREIGN KEY (root) REFERENCES te_service (id)');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB9BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB9324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_status ADD CONSTRAINT FK_CC127549BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_status ADD CONSTRAINT FK_CC127549324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E3D8E604F');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E16F4F95B');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB93D8E604F');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB916F4F95B');
        $this->addSql('ALTER TABLE te_criticity DROP FOREIGN KEY FK_A83E3E22BC06EA63');
        $this->addSql('ALTER TABLE te_criticity DROP FOREIGN KEY FK_A83E3E22324F23A6');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310EBC06EA63');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E324F23A6');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB9BC06EA63');
        $this->addSql('ALTER TABLE te_service DROP FOREIGN KEY FK_FA2B2DB9324F23A6');
        $this->addSql('ALTER TABLE te_status DROP FOREIGN KEY FK_CC127549BC06EA63');
        $this->addSql('ALTER TABLE te_status DROP FOREIGN KEY FK_CC127549324F23A6');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE te_criticity');
        $this->addSql('DROP TABLE te_family');
        $this->addSql('DROP TABLE te_service');
        $this->addSql('DROP TABLE te_status');
        $this->addSql('DROP TABLE te_user');
    }
}
