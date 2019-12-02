<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202123347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_8F87BF96B3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE filiere_niveau (filiere_id INT NOT NULL, niveau_id INT NOT NULL, INDEX IDX_7413A5F4180AA129 (filiere_id), INDEX IDX_7413A5F4B3E9C81 (niveau_id), PRIMARY KEY(filiere_id, niveau_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stage (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, description VARCHAR(255) NOT NULL, sujet VARCHAR(255) NOT NULL, INDEX IDX_C27C9369C54C8C93 (type_id), INDEX IDX_C27C9369E455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE filiere_niveau ADD CONSTRAINT FK_7413A5F4180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE filiere_niveau ADD CONSTRAINT FK_7413A5F4B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES enseignant (id)');
        $this->addSql('ALTER TABLE admin CHANGE email email VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD ecole_id INT DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE enseignant ADD CONSTRAINT FK_81A72FA177EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_81A72FA177EF1B1E ON enseignant (ecole_id)');
        $this->addSql('ALTER TABLE etudiant ADD ecole_id INT DEFAULT NULL, ADD classe_id INT DEFAULT NULL, ADD stage_id INT DEFAULT NULL, CHANGE email email VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E377EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E32298D193 FOREIGN KEY (stage_id) REFERENCES stage (id)');
        $this->addSql('CREATE INDEX IDX_717E22E377EF1B1E ON etudiant (ecole_id)');
        $this->addSql('CREATE INDEX IDX_717E22E38F5EA509 ON etudiant (classe_id)');
        $this->addSql('CREATE INDEX IDX_717E22E32298D193 ON etudiant (stage_id)');
        $this->addSql('ALTER TABLE filiere ADD ecole_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE filiere ADD CONSTRAINT FK_2ED05D9E77EF1B1E FOREIGN KEY (ecole_id) REFERENCES ecole (id)');
        $this->addSql('CREATE INDEX IDX_2ED05D9E77EF1B1E ON filiere (ecole_id)');
        $this->addSql('ALTER TABLE niveau ADD paiement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE niveau ADD CONSTRAINT FK_4BDFF36B2A4C4478 FOREIGN KEY (paiement_id) REFERENCES paiement (id)');
        $this->addSql('CREATE INDEX IDX_4BDFF36B2A4C4478 ON niveau (paiement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E38F5EA509');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E32298D193');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE filiere_niveau');
        $this->addSql('DROP TABLE stage');
        $this->addSql('ALTER TABLE admin CHANGE email email VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE enseignant DROP FOREIGN KEY FK_81A72FA177EF1B1E');
        $this->addSql('DROP INDEX IDX_81A72FA177EF1B1E ON enseignant');
        $this->addSql('ALTER TABLE enseignant DROP ecole_id, CHANGE email email VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E377EF1B1E');
        $this->addSql('DROP INDEX IDX_717E22E377EF1B1E ON etudiant');
        $this->addSql('DROP INDEX IDX_717E22E38F5EA509 ON etudiant');
        $this->addSql('DROP INDEX IDX_717E22E32298D193 ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP ecole_id, DROP classe_id, DROP stage_id, CHANGE email email VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE filiere DROP FOREIGN KEY FK_2ED05D9E77EF1B1E');
        $this->addSql('DROP INDEX IDX_2ED05D9E77EF1B1E ON filiere');
        $this->addSql('ALTER TABLE filiere DROP ecole_id');
        $this->addSql('ALTER TABLE niveau DROP FOREIGN KEY FK_4BDFF36B2A4C4478');
        $this->addSql('DROP INDEX IDX_4BDFF36B2A4C4478 ON niveau');
        $this->addSql('ALTER TABLE niveau DROP paiement_id');
    }
}
