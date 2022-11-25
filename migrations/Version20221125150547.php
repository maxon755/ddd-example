<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221125150547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vending_machines (serial_number VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, operator_phone VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', activated_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', last_requested_at DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', PRIMARY KEY(serial_number)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE vending_machines');
    }
}
