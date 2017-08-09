<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170809081031 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE te_status (id INT AUTO_INCREMENT NOT NULL COMMENT \'Status id\', creator INT NOT NULL, updater INT NOT NULL, created DATETIME NOT NULL COMMENT \'Creation date\', updated DATETIME DEFAULT NULL COMMENT \'Last update datetime\', name VARCHAR(16) NOT NULL COMMENT \'Status name\', initial TINYINT(1) DEFAULT \'0\' COMMENT \'Is it the initial status\', discarded TINYINT(1) DEFAULT \'0\' COMMENT \'Is it a discarded status\', managed TINYINT(1) DEFAULT \'0\' COMMENT \'is it subject to calendar management\', presentation LONGTEXT DEFAULT NULL COMMENT \'markdown presentation of text\', UNIQUE INDEX UNIQ_CC1275495E237E06 (name), INDEX IDX_CC127549BC06EA63 (creator), INDEX IDX_CC127549324F23A6 (updater), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
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

        $this->addSql('DROP TABLE te_status');
    }
}
