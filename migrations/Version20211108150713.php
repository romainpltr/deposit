<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108150713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deposit_group (deposit_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_E796591E9815E4B1 (deposit_id), INDEX IDX_E796591EFE54D947 (group_id), PRIMARY KEY(deposit_id, group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deposit_group ADD CONSTRAINT FK_E796591E9815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deposit_group ADD CONSTRAINT FK_E796591EFE54D947 FOREIGN KEY (group_id) REFERENCES `group` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE deposit_group');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
