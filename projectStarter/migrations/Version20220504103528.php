<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220504103528 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, age INTEGER NOT NULL, solicitor VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE reviews (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rating INTEGER NOT NULL, review VARCHAR(255) NOT NULL, rekekekemend BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE secret_mode (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, daredevil BOOLEAN NOT NULL, successful_nights INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE solicitors (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, courts VARCHAR(255) NOT NULL, clients VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64919EB6921 ON user (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE secret_mode');
        $this->addSql('DROP TABLE solicitors');
        $this->addSql('DROP TABLE user');
    }
}
