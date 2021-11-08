<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108151803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit DROP INDEX UNIQ_95DB9D3961220EA6, ADD INDEX IDX_95DB9D3961220EA6 (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deposit DROP INDEX IDX_95DB9D3961220EA6, ADD UNIQUE INDEX UNIQ_95DB9D3961220EA6 (creator_id)');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
