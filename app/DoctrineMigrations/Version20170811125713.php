<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170811125713 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE te_criticity (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant of criticity\', creator INT NOT NULL, updater INT NOT NULL, name VARCHAR(16) NOT NULL COMMENT \'Name of the criticity\', intervention VARCHAR(8) NOT NULL COMMENT \'Intervention period\', recovery VARCHAR(8) NOT NULL COMMENT \'Recovery period\', created DATETIME NOT NULL COMMENT \'Creation datetime\', updated DATETIME NOT NULL COMMENT \'Update datetime\', working VARCHAR(8) DEFAULT NULL COMMENT \'Average working time target (cible MTBF)\', INDEX IDX_A83E3E22BC06EA63 (creator), INDEX IDX_A83E3E22324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Cricity of equipment\' ');
        $this->addSql('CREATE TABLE te_service (id INT AUTO_INCREMENT NOT NULL COMMENT \'Family ID\', left_tree INT NOT NULL COMMENT \'Left born of the tree\', right_tree INT NOT NULL COMMENT \'Right born of the tree\', level_tree INT NOT NULL COMMENT \'Level on the tree\', name VARCHAR(32) NOT NULL COMMENT \'Family name\', slug VARCHAR(255) NOT NULL COMMENT \'Name sluggified\', created DATETIME NOT NULL COMMENT \'Creation date\', updated DATETIME DEFAULT NULL COMMENT \'Last update datetime\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Service of the enterprise\' ');
        $this->addSql('ALTER TABLE te_criticity ADD CONSTRAINT FK_A83E3E22BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_criticity ADD CONSTRAINT FK_A83E3E22324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE te_criticity');
        $this->addSql('DROP TABLE te_service');
    }
}
