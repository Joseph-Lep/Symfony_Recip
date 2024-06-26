<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240603145630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, seasonality VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recip (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, text VARCHAR(255) NOT NULL, dateofcreate DATETIME NOT NULL, img LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recipingredient (id INT AUTO_INCREMENT NOT NULL, idrecip_id INT DEFAULT NULL, idingredient_id INT DEFAULT NULL, INDEX IDX_1B22B621071B6BD (idrecip_id), INDEX IDX_1B22B62EAA5F757 (idingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recipingredient ADD CONSTRAINT FK_1B22B621071B6BD FOREIGN KEY (idrecip_id) REFERENCES recip (id)');
        $this->addSql('ALTER TABLE recipingredient ADD CONSTRAINT FK_1B22B62EAA5F757 FOREIGN KEY (idingredient_id) REFERENCES ingredient (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipingredient DROP FOREIGN KEY FK_1B22B621071B6BD');
        $this->addSql('ALTER TABLE recipingredient DROP FOREIGN KEY FK_1B22B62EAA5F757');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE recip');
        $this->addSql('DROP TABLE recipingredient');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
