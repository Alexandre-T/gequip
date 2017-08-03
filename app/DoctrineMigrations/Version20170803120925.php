<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170803120925 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE te_family (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la family\', parent_tree INT DEFAULT NULL COMMENT \'Identifiant de la family\', root_tree INT DEFAULT NULL COMMENT \'Identifiant de la family\', creator INT NOT NULL, left_tree INT NOT NULL COMMENT \'Borne gauche de l\'\'arbre\', right_tree INT NOT NULL COMMENT \'Borne droite de l\'\'arbre\', level_tree INT NOT NULL COMMENT \'Niveau de l\'\'arbre\', name VARCHAR(32) NOT NULL COMMENT \'Nom de la family\', created DATETIME NOT NULL COMMENT \'Date de création automatique\', INDEX IDX_12F4310E8ADD6868 (parent_tree), INDEX IDX_12F4310EF0E3E7EB (root_tree), INDEX IDX_12F4310EBC06EA63 (creator), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Famille d\'\'équipements routiers\' ');
        $this->addSql('CREATE TABLE te_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', presentation LONGTEXT DEFAULT NULL COMMENT \'Description Markdown de l\'\'utilisateur\', created DATETIME NOT NULL COMMENT \'Date de création automatique\', UNIQUE INDEX UNIQ_CBE6E4E092FC23A8 (username_canonical), UNIQUE INDEX UNIQ_CBE6E4E0A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_CBE6E4E0C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Utilisateur métier\' ');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E8ADD6868 FOREIGN KEY (parent_tree) REFERENCES te_family (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310EF0E3E7EB FOREIGN KEY (root_tree) REFERENCES te_family (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310EBC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310E8ADD6868');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310EF0E3E7EB');
        $this->addSql('ALTER TABLE te_family DROP FOREIGN KEY FK_12F4310EBC06EA63');
        $this->addSql('DROP TABLE te_family');
        $this->addSql('DROP TABLE te_user');
    }
}
