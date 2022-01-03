<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211230223950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, reference VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, transporteurs VARCHAR(255) NOT NULL, transporteur_prix DOUBLE PRECISION NOT NULL, adresse LONGTEXT NOT NULL, is_paid TINYINT(1) NOT NULL, plus_infos LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, quantity INT NOT NULL, sub_total_ttc DOUBLE PRECISION NOT NULL, taxe DOUBLE PRECISION NOT NULL, INDEX IDX_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detaile_cart (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, prix_produit DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, prix_total DOUBLE PRECISION NOT NULL, taxe DOUBLE PRECISION NOT NULL, prix_total_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_8E97173E82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE detaile_cart ADD CONSTRAINT FK_8E97173E82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE detaile_cart');
    }
}
