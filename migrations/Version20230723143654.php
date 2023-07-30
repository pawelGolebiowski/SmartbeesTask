<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230723143654 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE order_summary (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, shipping_method_id INT NOT NULL, payment_method_id INT NOT NULL, discount_code VARCHAR(50) DEFAULT NULL, INDEX IDX_3852CF28A76ED395 (user_id), INDEX IDX_3852CF285F7D6850 (shipping_method_id), INDEX IDX_3852CF285AA1164F (payment_method_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_method (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shipping_method (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(255) NOT NULL, phone VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_summary ADD CONSTRAINT FK_3852CF28A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE order_summary ADD CONSTRAINT FK_3852CF285F7D6850 FOREIGN KEY (shipping_method_id) REFERENCES shipping_method (id)');
        $this->addSql('ALTER TABLE order_summary ADD CONSTRAINT FK_3852CF285AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_summary DROP FOREIGN KEY FK_3852CF28A76ED395');
        $this->addSql('ALTER TABLE order_summary DROP FOREIGN KEY FK_3852CF285F7D6850');
        $this->addSql('ALTER TABLE order_summary DROP FOREIGN KEY FK_3852CF285AA1164F');
        $this->addSql('DROP TABLE order_summary');
        $this->addSql('DROP TABLE payment_method');
        $this->addSql('DROP TABLE shipping_method');
        $this->addSql('DROP TABLE `user`');
    }
}
