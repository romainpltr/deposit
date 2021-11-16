<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211116023914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E68809D86650F');
        $this->addSql('DROP INDEX UNIQ_534E68809D86650F ON work');
        $this->addSql('ALTER TABLE work ADD creator_id INT NOT NULL, DROP user_id_id');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68809815E4B1 FOREIGN KEY (deposit_id) REFERENCES deposit (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E688061220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_534E68809815E4B1 ON work (deposit_id)');
        $this->addSql('CREATE INDEX IDX_534E688061220EA6 ON work (creator_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E68809815E4B1');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E688061220EA6');
        $this->addSql('DROP INDEX IDX_534E68809815E4B1 ON work');
        $this->addSql('DROP INDEX IDX_534E688061220EA6 ON work');
        $this->addSql('ALTER TABLE work ADD user_id_id INT DEFAULT NULL, DROP creator_id');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68809D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_534E68809D86650F ON work (user_id_id)');
    }
}
