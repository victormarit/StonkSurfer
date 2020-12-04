<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204000410 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consommable (id INT AUTO_INCREMENT NOT NULL, id_type_id INT DEFAULT NULL, nom_produit VARCHAR(255) NOT NULL, commentaire VARCHAR(255) DEFAULT NULL, note DOUBLE PRECISION NOT NULL, INDEX IDX_A04C7F4D1BD125E3 (id_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peut_se_pratiquer (id INT AUTO_INCREMENT NOT NULL, id_spot_id INT NOT NULL, id_sport_id INT NOT NULL, INDEX IDX_2C57CBEBF36C7A0C (id_spot_id), INDEX IDX_2C57CBEBFCA3506D (id_sport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plage (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, id_sport_id INT DEFAULT NULL, id_spot_id INT DEFAULT NULL, id_utilisateur_id INT NOT NULL, note_performance DOUBLE PRECISION DEFAULT NULL, note_ecologique DOUBLE PRECISION DEFAULT NULL, note_estimation_api DOUBLE PRECISION DEFAULT NULL, note_infrastructure DOUBLE PRECISION DEFAULT NULL, date_session_debut DATETIME NOT NULL, duree_session TIME DEFAULT NULL, photos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', commentaire VARCHAR(500) DEFAULT NULL, public TINYINT(1) NOT NULL, INDEX IDX_D044D5D4FCA3506D (id_sport_id), INDEX IDX_D044D5D4F36C7A0C (id_spot_id), INDEX IDX_D044D5D4C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sport (id INT AUTO_INCREMENT NOT NULL, nom_pratique VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spot (id INT AUTO_INCREMENT NOT NULL, id_plage_id INT DEFAULT NULL, lieu VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, longitude DOUBLE PRECISION NOT NULL, latitude DOUBLE PRECISION NOT NULL, niveau_accessibilite DOUBLE PRECISION DEFAULT NULL, INDEX IDX_B9327A73A8FDE84C (id_plage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, nom_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_connection DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consommable ADD CONSTRAINT FK_A04C7F4D1BD125E3 FOREIGN KEY (id_type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE peut_se_pratiquer ADD CONSTRAINT FK_2C57CBEBF36C7A0C FOREIGN KEY (id_spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE peut_se_pratiquer ADD CONSTRAINT FK_2C57CBEBFCA3506D FOREIGN KEY (id_sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4FCA3506D FOREIGN KEY (id_sport_id) REFERENCES sport (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4F36C7A0C FOREIGN KEY (id_spot_id) REFERENCES spot (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D4C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE spot ADD CONSTRAINT FK_B9327A73A8FDE84C FOREIGN KEY (id_plage_id) REFERENCES plage (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE spot DROP FOREIGN KEY FK_B9327A73A8FDE84C');
        $this->addSql('ALTER TABLE peut_se_pratiquer DROP FOREIGN KEY FK_2C57CBEBFCA3506D');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4FCA3506D');
        $this->addSql('ALTER TABLE peut_se_pratiquer DROP FOREIGN KEY FK_2C57CBEBF36C7A0C');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4F36C7A0C');
        $this->addSql('ALTER TABLE consommable DROP FOREIGN KEY FK_A04C7F4D1BD125E3');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D4C6EE5C49');
        $this->addSql('DROP TABLE consommable');
        $this->addSql('DROP TABLE peut_se_pratiquer');
        $this->addSql('DROP TABLE plage');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE sport');
        $this->addSql('DROP TABLE spot');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE utilisateur');
    }
}
