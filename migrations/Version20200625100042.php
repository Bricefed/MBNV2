<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200625100042 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, note VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, img_user VARCHAR(255) NOT NULL, img_meuble VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE essence (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meuble (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, categorie_id INT NOT NULL, img VARCHAR(255) NOT NULL, titre VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_B758BB86C54C8C93 (type_id), INDEX IDX_B758BB86BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, avis_id INT NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8CDE5729197E709F (avis_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meuble ADD CONSTRAINT FK_B758BB86C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE meuble ADD CONSTRAINT FK_B758BB86BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE type ADD CONSTRAINT FK_8CDE5729197E709F FOREIGN KEY (avis_id) REFERENCES avis (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type DROP FOREIGN KEY FK_8CDE5729197E709F');
        $this->addSql('ALTER TABLE meuble DROP FOREIGN KEY FK_B758BB86BCF5E72D');
        $this->addSql('ALTER TABLE meuble DROP FOREIGN KEY FK_B758BB86C54C8C93');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE essence');
        $this->addSql('DROP TABLE meuble');
        $this->addSql('DROP TABLE type');
    }
}
