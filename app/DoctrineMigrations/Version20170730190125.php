<?php
/**
 * This file is part of the GEquip Application.
 *
 * PHP version 7.1
 *
 * (c) Alexandre Tranchant <alexandre.tranchant@gmail.com>
 *
 * @category  Doctrine Migrations
 *
 * @author    Alexandre Tranchant <alexandre.tranchant@gmail.com>
 * @copyright 2017 Alexandre Tranchant
 * @license   GNU General Public License, version 3
 *
 * @link      http://opensource.org/licenses/GPL-3.0
 */

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration.
 */
class Version20170730190125 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE te_famille (id INT AUTO_INCREMENT NOT NULL COMMENT \'Identifiant de la famille\', parent_tree INT DEFAULT NULL COMMENT \'Identifiant de la famille\', root_tree INT DEFAULT NULL COMMENT \'Identifiant de la famille\', left_tree INT NOT NULL COMMENT \'Borne gauche de l\'\'arbre\', right_tree INT NOT NULL COMMENT \'Borne droite de l\'\'arbre\', level_tree INT NOT NULL COMMENT \'Niveau de l\'\'arbre\', name VARCHAR(32) NOT NULL COMMENT \'Nom de la famille\', INDEX IDX_3FC545788ADD6868 (parent_tree), INDEX IDX_3FC54578F0E3E7EB (root_tree), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'Famille d\'\'équipements routiers\' ');
        $this->addSql('ALTER TABLE te_famille ADD CONSTRAINT FK_FAMILLE_PARENT FOREIGN KEY (parent_tree) REFERENCES te_famille (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE te_famille ADD CONSTRAINT FK_FAMILLE_ROOT FOREIGN KEY (root_tree) REFERENCES te_famille (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE te_famille DROP FOREIGN KEY FK_FAMILLE_PARENT');
        $this->addSql('ALTER TABLE te_famille DROP FOREIGN KEY FK_FAMILLE_ROOT');
        $this->addSql('DROP TABLE te_famille');
    }
}
