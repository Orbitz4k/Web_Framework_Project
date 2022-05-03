<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503104848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, password, role FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER DEFAULT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES clients (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, username, password, role) SELECT id, username, password, role FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64919EB6921 ON user (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('DROP INDEX UNIQ_8D93D64919EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, username, password, role FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, username, password, role) SELECT id, username, password, role FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }
}
