<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415002758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, full_name VARCHAR(255) NOT NULL, nom_entreprise VARCHAR(255) DEFAULT NULL, address LONGTEXT NOT NULL, complement LONGTEXT DEFAULT NULL, phone INT NOT NULL, city VARCHAR(255) NOT NULL, bodepostal INT NOT NULL, country VARCHAR(255) NOT NULL, INDEX IDX_C35F0816A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, reference VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, transporteurs VARCHAR(255) NOT NULL, transporteur_prix DOUBLE PRECISION NOT NULL, adresse LONGTEXT NOT NULL, is_paid TINYINT(1) NOT NULL, plus_infos LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, quantity INT NOT NULL, sub_total_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, reference VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, transporteurs VARCHAR(255) NOT NULL, transporteur_prix DOUBLE PRECISION NOT NULL, adresse LONGTEXT NOT NULL, is_paid TINYINT(1) NOT NULL, plus_infos LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, quantity INT NOT NULL, sub_total_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_6EEAA67DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detaile_cart (id INT AUTO_INCREMENT NOT NULL, cart_id INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, prix_produit DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, prix_total DOUBLE PRECISION NOT NULL, prix_total_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_8E97173E1AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE detaile_commande (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, nom_produit VARCHAR(255) NOT NULL, prix_produit DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, prix_total_ttc DOUBLE PRECISION NOT NULL, INDEX IDX_2E0C245982EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, plus_infos LONGTEXT DEFAULT NULL, meilleur_vente TINYINT(1) DEFAULT NULL, produit_vedette TINYINT(1) DEFAULT NULL, image VARCHAR(255) NOT NULL, quantity INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', tags LONGTEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, FULLTEXT INDEX IDX_29A5EC276C6E55B56DE44026 (nom, description), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_categories (produit_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_93CB7F65F347EFB (produit_id), INDEX IDX_93CB7F65A21214B7 (categories_id), PRIMARY KEY(produit_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relation_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, INDEX IDX_30DEFE56F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews_product (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, note INT NOT NULL, coment LONGTEXT DEFAULT NULL, INDEX IDX_E0851D6CA76ED395 (user_id), INDEX IDX_E0851D6C4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transporteurs (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, prix DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, update_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE detaile_cart ADD CONSTRAINT FK_8E97173E1AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE detaile_commande ADD CONSTRAINT FK_2E0C245982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE produit_categories ADD CONSTRAINT FK_93CB7F65F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_categories ADD CONSTRAINT FK_93CB7F65A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relation_produit ADD CONSTRAINT FK_30DEFE56F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reviews_product ADD CONSTRAINT FK_E0851D6CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reviews_product ADD CONSTRAINT FK_E0851D6C4584665A FOREIGN KEY (product_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detaile_cart DROP FOREIGN KEY FK_8E97173E1AD5CDBF');
        $this->addSql('ALTER TABLE produit_categories DROP FOREIGN KEY FK_93CB7F65A21214B7');
        $this->addSql('ALTER TABLE detaile_commande DROP FOREIGN KEY FK_2E0C245982EA2E54');
        $this->addSql('ALTER TABLE produit_categories DROP FOREIGN KEY FK_93CB7F65F347EFB');
        $this->addSql('ALTER TABLE relation_produit DROP FOREIGN KEY FK_30DEFE56F347EFB');
        $this->addSql('ALTER TABLE reviews_product DROP FOREIGN KEY FK_E0851D6C4584665A');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7A76ED395');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE reviews_product DROP FOREIGN KEY FK_E0851D6CA76ED395');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE detaile_cart');
        $this->addSql('DROP TABLE detaile_commande');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_categories');
        $this->addSql('DROP TABLE relation_produit');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE reviews_product');
        $this->addSql('DROP TABLE transporteurs');
        $this->addSql('DROP TABLE user');
    }
}
