<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211028175325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deposit_user (deposit_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_BE47E1529815E4B1 (deposit_id), INDEX IDX_BE47E152A76ED395 (user_id), PRIMARY KEY(deposit_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deposit_user ADD CONSTRAINT FK_BE47E1529815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deposit_user ADD CONSTRAINT FK_BE47E152A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE deposit_user');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
