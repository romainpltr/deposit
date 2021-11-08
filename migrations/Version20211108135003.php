<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108135003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit ADD creator_id INT NOT NULL');
        $this->addSql('ALTER TABLE deposit ADD CONSTRAINT FK_95DB9D3961220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_95DB9D3961220EA6 ON deposit (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit DROP FOREIGN KEY FK_95DB9D3961220EA6');
        $this->addSql('DROP INDEX UNIQ_95DB9D3961220EA6 ON deposit');
        $this->addSql('ALTER TABLE deposit DROP creator_id');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
