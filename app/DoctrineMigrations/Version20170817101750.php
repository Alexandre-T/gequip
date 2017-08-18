<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170817101750 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE ext_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE te_axe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE te_criticity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE te_family_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE te_service_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE te_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE te_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ext_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX log_class_lookup_idx ON ext_log_entries (object_class)');
        $this->addSql('CREATE INDEX log_date_lookup_idx ON ext_log_entries (logged_at)');
        $this->addSql('CREATE INDEX log_user_lookup_idx ON ext_log_entries (username)');
        $this->addSql('CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN ext_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE te_axe (id INT NOT NULL, creator INT NOT NULL, updater INT NOT NULL, name VARCHAR(16) NOT NULL, code VARCHAR(8) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, geometry Geometry DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E6CE835E237E06 ON te_axe (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E6CE8377153098 ON te_axe (code)');
        $this->addSql('CREATE INDEX IDX_70E6CE83BC06EA63 ON te_axe (creator)');
        $this->addSql('CREATE INDEX IDX_70E6CE83324F23A6 ON te_axe (updater)');
        $this->addSql('COMMENT ON COLUMN te_axe.id IS \'Identifiant of axe\'');
        $this->addSql('COMMENT ON COLUMN te_axe.name IS \'Name of the axe\'');
        $this->addSql('COMMENT ON COLUMN te_axe.code IS \'Code of the axe \'');
        $this->addSql('COMMENT ON COLUMN te_axe.created IS \'Creation datetime\'');
        $this->addSql('COMMENT ON COLUMN te_axe.updated IS \'Update datetime\'');
        $this->addSql('COMMENT ON COLUMN te_axe.geometry IS \'(DC2Type:geometry)\'');
        $this->addSql('CREATE TABLE te_criticity (id INT NOT NULL, creator INT NOT NULL, updater INT NOT NULL, name VARCHAR(16) NOT NULL, intervention VARCHAR(8) NOT NULL, recovery VARCHAR(8) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, working VARCHAR(8) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A83E3E22BC06EA63 ON te_criticity (creator)');
        $this->addSql('CREATE INDEX IDX_A83E3E22324F23A6 ON te_criticity (updater)');
        $this->addSql('COMMENT ON COLUMN te_criticity.id IS \'Identifiant of criticity\'');
        $this->addSql('COMMENT ON COLUMN te_criticity.intervention IS \'Intervention period\'');
        $this->addSql('COMMENT ON COLUMN te_criticity.recovery IS \'Recovery period\'');
        $this->addSql('COMMENT ON COLUMN te_criticity.created IS \'Creation datetime\'');
        $this->addSql('COMMENT ON COLUMN te_criticity.updated IS \'Update datetime\'');
        $this->addSql('COMMENT ON COLUMN te_criticity.working IS \'Average working time target (cible MTBF)\'');
        $this->addSql('CREATE TABLE te_family (id INT NOT NULL, parent INT DEFAULT NULL, root INT DEFAULT NULL, creator INT NOT NULL, updater INT DEFAULT NULL, left_tree INT NOT NULL, right_tree INT NOT NULL, level_tree INT NOT NULL, name VARCHAR(32) NOT NULL, slug VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_12F4310E3D8E604F ON te_family (parent)');
        $this->addSql('CREATE INDEX IDX_12F4310E16F4F95B ON te_family (root)');
        $this->addSql('CREATE INDEX IDX_12F4310EBC06EA63 ON te_family (creator)');
        $this->addSql('CREATE INDEX IDX_12F4310E324F23A6 ON te_family (updater)');
        $this->addSql('COMMENT ON COLUMN te_family.id IS \'Tree ID\'');
        $this->addSql('COMMENT ON COLUMN te_family.parent IS \'Tree ID\'');
        $this->addSql('COMMENT ON COLUMN te_family.root IS \'Tree ID\'');
        $this->addSql('COMMENT ON COLUMN te_family.left_tree IS \'Left born of the tree\'');
        $this->addSql('COMMENT ON COLUMN te_family.right_tree IS \'Right born of the tree\'');
        $this->addSql('COMMENT ON COLUMN te_family.level_tree IS \'Level on the tree\'');
        $this->addSql('COMMENT ON COLUMN te_family.name IS \'Node name\'');
        $this->addSql('COMMENT ON COLUMN te_family.slug IS \'Name sluggified\'');
        $this->addSql('COMMENT ON COLUMN te_family.created IS \'Creation date\'');
        $this->addSql('COMMENT ON COLUMN te_family.updated IS \'Last update datetime\'');
        $this->addSql('CREATE TABLE te_service (id INT NOT NULL, parent INT DEFAULT NULL, root INT DEFAULT NULL, creator INT NOT NULL, updater INT DEFAULT NULL, left_tree INT NOT NULL, right_tree INT NOT NULL, level_tree INT NOT NULL, name VARCHAR(32) NOT NULL, slug VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FA2B2DB93D8E604F ON te_service (parent)');
        $this->addSql('CREATE INDEX IDX_FA2B2DB916F4F95B ON te_service (root)');
        $this->addSql('CREATE INDEX IDX_FA2B2DB9BC06EA63 ON te_service (creator)');
        $this->addSql('CREATE INDEX IDX_FA2B2DB9324F23A6 ON te_service (updater)');
        $this->addSql('COMMENT ON COLUMN te_service.id IS \'Tree ID\'');
        $this->addSql('COMMENT ON COLUMN te_service.parent IS \'Tree ID\'');
        $this->addSql('COMMENT ON COLUMN te_service.root IS \'Tree ID\'');
        $this->addSql('COMMENT ON COLUMN te_service.left_tree IS \'Left born of the tree\'');
        $this->addSql('COMMENT ON COLUMN te_service.right_tree IS \'Right born of the tree\'');
        $this->addSql('COMMENT ON COLUMN te_service.level_tree IS \'Level on the tree\'');
        $this->addSql('COMMENT ON COLUMN te_service.name IS \'Node name\'');
        $this->addSql('COMMENT ON COLUMN te_service.slug IS \'Name sluggified\'');
        $this->addSql('COMMENT ON COLUMN te_service.created IS \'Creation date\'');
        $this->addSql('COMMENT ON COLUMN te_service.updated IS \'Last update datetime\'');
        $this->addSql('CREATE TABLE te_status (id INT NOT NULL, creator INT NOT NULL, updater INT NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, name VARCHAR(16) NOT NULL, initial BOOLEAN DEFAULT \'false\' NOT NULL, discarded BOOLEAN DEFAULT \'false\' NOT NULL, managed BOOLEAN DEFAULT \'false\' NOT NULL, presentation TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CC1275495E237E06 ON te_status (name)');
        $this->addSql('CREATE INDEX IDX_CC127549BC06EA63 ON te_status (creator)');
        $this->addSql('CREATE INDEX IDX_CC127549324F23A6 ON te_status (updater)');
        $this->addSql('COMMENT ON COLUMN te_status.id IS \'Status id\'');
        $this->addSql('COMMENT ON COLUMN te_status.created IS \'Creation date\'');
        $this->addSql('COMMENT ON COLUMN te_status.updated IS \'Last update datetime\'');
        $this->addSql('COMMENT ON COLUMN te_status.name IS \'Status name\'');
        $this->addSql('COMMENT ON COLUMN te_status.initial IS \'Is it the initial status\'');
        $this->addSql('COMMENT ON COLUMN te_status.discarded IS \'Is it a discarded status\'');
        $this->addSql('COMMENT ON COLUMN te_status.managed IS \'is it subject to calendar management\'');
        $this->addSql('COMMENT ON COLUMN te_status.presentation IS \'markdown presentation of text\'');
        $this->addSql('CREATE TABLE te_user (id INT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, presentation TEXT DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE6E4E092FC23A8 ON te_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE6E4E0A0D96FBF ON te_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE6E4E0C05FB297 ON te_user (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN te_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN te_user.presentation IS \'User presentation (markdown format)\'');
        $this->addSql('COMMENT ON COLUMN te_user.created IS \'Creation time of user\'');
        $this->addSql('ALTER TABLE te_axe ADD CONSTRAINT FK_70E6CE83BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_axe ADD CONSTRAINT FK_70E6CE83324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_criticity ADD CONSTRAINT FK_A83E3E22BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_criticity ADD CONSTRAINT FK_A83E3E22324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E3D8E604F FOREIGN KEY (parent) REFERENCES te_family (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E16F4F95B FOREIGN KEY (root) REFERENCES te_family (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310EBC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_family ADD CONSTRAINT FK_12F4310E324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB93D8E604F FOREIGN KEY (parent) REFERENCES te_service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB916F4F95B FOREIGN KEY (root) REFERENCES te_service (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB9BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_service ADD CONSTRAINT FK_FA2B2DB9324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_status ADD CONSTRAINT FK_CC127549BC06EA63 FOREIGN KEY (creator) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE te_status ADD CONSTRAINT FK_CC127549324F23A6 FOREIGN KEY (updater) REFERENCES te_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE te_family DROP CONSTRAINT FK_12F4310E3D8E604F');
        $this->addSql('ALTER TABLE te_family DROP CONSTRAINT FK_12F4310E16F4F95B');
        $this->addSql('ALTER TABLE te_service DROP CONSTRAINT FK_FA2B2DB93D8E604F');
        $this->addSql('ALTER TABLE te_service DROP CONSTRAINT FK_FA2B2DB916F4F95B');
        $this->addSql('ALTER TABLE te_axe DROP CONSTRAINT FK_70E6CE83BC06EA63');
        $this->addSql('ALTER TABLE te_axe DROP CONSTRAINT FK_70E6CE83324F23A6');
        $this->addSql('ALTER TABLE te_criticity DROP CONSTRAINT FK_A83E3E22BC06EA63');
        $this->addSql('ALTER TABLE te_criticity DROP CONSTRAINT FK_A83E3E22324F23A6');
        $this->addSql('ALTER TABLE te_family DROP CONSTRAINT FK_12F4310EBC06EA63');
        $this->addSql('ALTER TABLE te_family DROP CONSTRAINT FK_12F4310E324F23A6');
        $this->addSql('ALTER TABLE te_service DROP CONSTRAINT FK_FA2B2DB9BC06EA63');
        $this->addSql('ALTER TABLE te_service DROP CONSTRAINT FK_FA2B2DB9324F23A6');
        $this->addSql('ALTER TABLE te_status DROP CONSTRAINT FK_CC127549BC06EA63');
        $this->addSql('ALTER TABLE te_status DROP CONSTRAINT FK_CC127549324F23A6');
        $this->addSql('DROP SEQUENCE ext_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE te_axe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE te_criticity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE te_family_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE te_service_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE te_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE te_user_id_seq CASCADE');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE te_axe');
        $this->addSql('DROP TABLE te_criticity');
        $this->addSql('DROP TABLE te_family');
        $this->addSql('DROP TABLE te_service');
        $this->addSql('DROP TABLE te_status');
        $this->addSql('DROP TABLE te_user');
    }
}
