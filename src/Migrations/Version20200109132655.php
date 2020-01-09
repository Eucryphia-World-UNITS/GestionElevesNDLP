<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109132655 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, name VARCHAR(30) NOT NULL, annee_scolaire DATE NOT NULL, INDEX IDX_8F87BF9626F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cour_option (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cour_option_etudiant (cour_option_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_FA187E4D1BF1158C (cour_option_id), INDEX IDX_FA187E4DDDEAB1A3 (etudiant_id), PRIMARY KEY(cour_option_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cour_option_diplome (cour_option_id INT NOT NULL, diplome_id INT NOT NULL, INDEX IDX_33A809141BF1158C (cour_option_id), INDEX IDX_33A8091426F859E2 (diplome_id), PRIMARY KEY(cour_option_id, diplome_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diplome (id INT AUTO_INCREMENT NOT NULL, type_formation_id INT NOT NULL, name VARCHAR(30) NOT NULL, lv2_obligatoire TINYINT(1) NOT NULL, INDEX IDX_EB4C4D4ED543922B (type_formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enseignement_comp (id INT AUTO_INCREMENT NOT NULL, diplome_id INT NOT NULL, name VARCHAR(60) NOT NULL, INDEX IDX_86E81FC626F859E2 (diplome_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etablissement_origine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, etablissement_origine_id INT DEFAULT NULL, classe_id INT NOT NULL, enseignement_comp_id INT DEFAULT NULL, lastname VARCHAR(60) NOT NULL, firstname VARCHAR(60) NOT NULL, sexe VARCHAR(1) NOT NULL, birth_date DATE DEFAULT NULL, status VARCHAR(30) NOT NULL, lv2 VARCHAR(60) DEFAULT NULL, note LONGTEXT DEFAULT NULL, arrangement LONGTEXT DEFAULT NULL, INDEX IDX_717E22E334849FFF (etablissement_origine_id), INDEX IDX_717E22E38F5EA509 (classe_id), INDEX IDX_717E22E390E84B90 (enseignement_comp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialisation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(60) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialisation_etudiant (specialisation_id INT NOT NULL, etudiant_id INT NOT NULL, INDEX IDX_44F859445627D44C (specialisation_id), INDEX IDX_44F85944DDEAB1A3 (etudiant_id), PRIMARY KEY(specialisation_id, etudiant_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialisation_classe (specialisation_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_5FC772FB5627D44C (specialisation_id), INDEX IDX_5FC772FB8F5EA509 (classe_id), PRIMARY KEY(specialisation_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_formation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF9626F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE cour_option_etudiant ADD CONSTRAINT FK_FA187E4D1BF1158C FOREIGN KEY (cour_option_id) REFERENCES cour_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cour_option_etudiant ADD CONSTRAINT FK_FA187E4DDDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cour_option_diplome ADD CONSTRAINT FK_33A809141BF1158C FOREIGN KEY (cour_option_id) REFERENCES cour_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cour_option_diplome ADD CONSTRAINT FK_33A8091426F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE diplome ADD CONSTRAINT FK_EB4C4D4ED543922B FOREIGN KEY (type_formation_id) REFERENCES type_formation (id)');
        $this->addSql('ALTER TABLE enseignement_comp ADD CONSTRAINT FK_86E81FC626F859E2 FOREIGN KEY (diplome_id) REFERENCES diplome (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E334849FFF FOREIGN KEY (etablissement_origine_id) REFERENCES etablissement_origine (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E390E84B90 FOREIGN KEY (enseignement_comp_id) REFERENCES enseignement_comp (id)');
        $this->addSql('ALTER TABLE specialisation_etudiant ADD CONSTRAINT FK_44F859445627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialisation_etudiant ADD CONSTRAINT FK_44F85944DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialisation_classe ADD CONSTRAINT FK_5FC772FB5627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE specialisation_classe ADD CONSTRAINT FK_5FC772FB8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E38F5EA509');
        $this->addSql('ALTER TABLE specialisation_classe DROP FOREIGN KEY FK_5FC772FB8F5EA509');
        $this->addSql('ALTER TABLE cour_option_etudiant DROP FOREIGN KEY FK_FA187E4D1BF1158C');
        $this->addSql('ALTER TABLE cour_option_diplome DROP FOREIGN KEY FK_33A809141BF1158C');
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF9626F859E2');
        $this->addSql('ALTER TABLE cour_option_diplome DROP FOREIGN KEY FK_33A8091426F859E2');
        $this->addSql('ALTER TABLE enseignement_comp DROP FOREIGN KEY FK_86E81FC626F859E2');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E390E84B90');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E334849FFF');
        $this->addSql('ALTER TABLE cour_option_etudiant DROP FOREIGN KEY FK_FA187E4DDDEAB1A3');
        $this->addSql('ALTER TABLE specialisation_etudiant DROP FOREIGN KEY FK_44F85944DDEAB1A3');
        $this->addSql('ALTER TABLE specialisation_etudiant DROP FOREIGN KEY FK_44F859445627D44C');
        $this->addSql('ALTER TABLE specialisation_classe DROP FOREIGN KEY FK_5FC772FB5627D44C');
        $this->addSql('ALTER TABLE diplome DROP FOREIGN KEY FK_EB4C4D4ED543922B');
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
    }
}
