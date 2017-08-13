<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170813172135 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE te_axe (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant of axe\', creator INT NOT NULL, updater INT NOT NULL, name VARCHAR(16) NOT NULL COMMENT \'Name of the axe\', code VARCHAR(8) NOT NULL COMMENT \'Code of the axe \', created DATETIME NOT NULL COMMENT \'Creation datetime\', updated DATETIME NOT NULL COMMENT \'Update datetime\', INDEX IDX_70E6CE83BC06EA63 (creator), INDEX IDX_70E6CE83324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Axe of equipment\' ');
        $this->addSql('ALTER TABLE te_axe ADD CONSTRAINT FK_70E6CE83BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_axe ADD CONSTRAINT FK_70E6CE83324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id)');
        $this->addSql('ALTER TABLE te_criticity CHANGE name name VARCHAR(16) NOT NULL COMMENT \'Name of the criticity\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE te_axe');
        $this->addSql('ALTER TABLE te_criticity CHANGE name name VARCHAR(16) NOT NULL COLLATE utf8_unicode_ci COMMENT \'Name of the criticity\'');
    }
}
