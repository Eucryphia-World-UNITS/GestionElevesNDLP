<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200305161837 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE classe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cour_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE diplome_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE enseignement_comp_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etablissement_origine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etudiant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE specialisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_formation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE identifiant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE classe (id INT NOT NULL, diplome_id INT NOT NULL, name VARCHAR(30) NOT NULL, annee_scolaire DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8F87BF9626F859E2 ON classe (diplome_id)');
        $this->addSql('CREATE TABLE cour_option (id INT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cour_option_etudiant (cour_option_id INT NOT NULL, etudiant_id INT NOT NULL, PRIMARY KEY(cour_option_id, etudiant_id))');
        $this->addSql('CREATE INDEX IDX_FA187E4D1BF1158C ON cour_option_etudiant (cour_option_id)');
        $this->addSql('CREATE INDEX IDX_FA187E4DDDEAB1A3 ON cour_option_etudiant (etudiant_id)');
        $this->addSql('CREATE TABLE cour_option_diplome (cour_option_id INT NOT NULL, diplome_id INT NOT NULL, PRIMARY KEY(cour_option_id, diplome_id))');
        $this->addSql('CREATE INDEX IDX_33A809141BF1158C ON cour_option_diplome (cour_option_id)');
        $this->addSql('CREATE INDEX IDX_33A8091426F859E2 ON cour_option_diplome (diplome_id)');
        $this->addSql('CREATE TABLE diplome (id INT NOT NULL, type_formation_id INT NOT NULL, name VARCHAR(30) NOT NULL, lv2_obligatoire BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EB4C4D4ED543922B ON diplome (type_formation_id)');
        $this->addSql('CREATE TABLE enseignement_comp (id INT NOT NULL, diplome_id INT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_86E81FC626F859E2 ON enseignement_comp (diplome_id)');
        $this->addSql('CREATE TABLE etablissement_origine (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etudiant (id INT NOT NULL, etablissement_origine_id INT DEFAULT NULL, classe_id INT NOT NULL, enseignement_comp_id INT DEFAULT NULL, lastname VARCHAR(60) NOT NULL, firstname VARCHAR(60) NOT NULL, sexe VARCHAR(1) NOT NULL, birth_date DATE DEFAULT NULL, status VARCHAR(30) NOT NULL, lv2 VARCHAR(60) DEFAULT NULL, note TEXT DEFAULT NULL, arrangement TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_717E22E334849FFF ON etudiant (etablissement_origine_id)');
        $this->addSql('CREATE INDEX IDX_717E22E38F5EA509 ON etudiant (classe_id)');
        $this->addSql('CREATE INDEX IDX_717E22E390E84B90 ON etudiant (enseignement_comp_id)');
        $this->addSql('CREATE TABLE specialisation (id INT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE specialisation_etudiant (specialisation_id INT NOT NULL, etudiant_id INT NOT NULL, PRIMARY KEY(specialisation_id, etudiant_id))');
        $this->addSql('CREATE INDEX IDX_44F859445627D44C ON specialisation_etudiant (specialisation_id)');
        $this->addSql('CREATE INDEX IDX_44F85944DDEAB1A3 ON specialisation_etudiant (etudiant_id)');
        $this->addSql('CREATE TABLE specialisation_classe (specialisation_id INT NOT NULL, classe_id INT NOT NULL, PRIMARY KEY(specialisation_id, classe_id))');
        $this->addSql('CREATE INDEX IDX_5FC772FB5627D44C ON specialisation_classe (specialisation_id)');
        $this->addSql('CREATE INDEX IDX_5FC772FB8F5EA509 ON specialisation_classe (classe_id)');
        $this->addSql('CREATE TABLE type_formation (id INT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE identifiant (id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C90409ECF85E0677 ON identifiant (username)');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9626F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cour_option_etudiant ADD CONSTRAINT FK_FA187E4D1BF1158C FOREIGN KEY (cour_option_id) REFERENCES cour_option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cour_option_etudiant ADD CONSTRAINT FK_FA187E4DDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cour_option_diplome ADD CONSTRAINT FK_33A809141BF1158C FOREIGN KEY (cour_option_id) REFERENCES cour_option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cour_option_diplome ADD CONSTRAINT FK_33A8091426F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4ED543922B FOREIGN KEY (type_formation_id) REFERENCES type_formation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE enseignement_comp ADD CONSTRAINT FK_86E81FC626F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E334849FFF FOREIGN KEY (etablissement_origine_id) REFERENCES etablissement_origine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E390E84B90 FOREIGN KEY (enseignement_comp_id) REFERENCES enseignement_comp (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE specialisation_etudiant ADD CONSTRAINT FK_44F859445627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE specialisation_etudiant ADD CONSTRAINT FK_44F85944DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE specialisation_classe ADD CONSTRAINT FK_5FC772FB5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE specialisation_classe ADD CONSTRAINT FK_5FC772FB8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT FK_717E22E38F5EA509');
        $this->addSql('ALTER TABLE specialisation_classe DROP CONSTRAINT FK_5FC772FB8F5EA509');
        $this->addSql('ALTER TABLE cour_option_etudiant DROP CONSTRAINT FK_FA187E4D1BF1158C');
        $this->addSql('ALTER TABLE cour_option_diplome DROP CONSTRAINT FK_33A809141BF1158C');
        $this->addSql('ALTER TABLE classe DROP CONSTRAINT FK_8F87BF9626F859E2');
        $this->addSql('ALTER TABLE cour_option_diplome DROP CONSTRAINT FK_33A8091426F859E2');
        $this->addSql('ALTER TABLE enseignement_comp DROP CONSTRAINT FK_86E81FC626F859E2');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT FK_717E22E390E84B90');
        $this->addSql('ALTER TABLE etudiant DROP CONSTRAINT FK_717E22E334849FFF');
        $this->addSql('ALTER TABLE cour_option_etudiant DROP CONSTRAINT FK_FA187E4DDDEAB1A3');
        $this->addSql('ALTER TABLE specialisation_etudiant DROP CONSTRAINT FK_44F85944DDEAB1A3');
        $this->addSql('ALTER TABLE specialisation_etudiant DROP CONSTRAINT FK_44F859445627D44C');
        $this->addSql('ALTER TABLE specialisation_classe DROP CONSTRAINT FK_5FC772FB5627D44C');
        $this->addSql('ALTER TABLE diplome DROP CONSTRAINT FK_EB4C4D4ED543922B');
        $this->addSql('DROP SEQUENCE classe_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cour_option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE diplome_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE enseignement_comp_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etablissement_origine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etudiant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE specialisation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_formation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE identifiant_id_seq CASCADE');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE cour_option');
        $this->addSql('DROP TABLE cour_option_etudiant');
        $this->addSql('DROP TABLE cour_option_diplome');
        $this->addSql('DROP TABLE diplome');
        $this->addSql('DROP TABLE enseignement_comp');
        $this->addSql('DROP TABLE etablissement_origine');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE specialisation');
        $this->addSql('DROP TABLE specialisation_etudiant');
        $this->addSql('DROP TABLE specialisation_classe');
        $this->addSql('DROP TABLE type_formation');
        $this->addSql('DROP TABLE identifiant');
    }
}
