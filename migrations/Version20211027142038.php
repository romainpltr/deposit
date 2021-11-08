<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211027142038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE workfile (id INT AUTO_INCREMENT NOT NULL, work_id INT DEFAULT NULL, INDEX IDX_BB9A7876BB3453DB (work_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE workfile ADD CONSTRAINT FK_BB9A7876BB3453DB FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('ALTER TABLE work ADD category_id INT NOT NULL, DROP file_name, DROP file_original_name, DROP file_mime_type, DROP file_dimensions, CHANGE file_size user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E68809D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE work ADD CONSTRAINT FK_534E688012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_534E68809D86650F ON work (user_id_id)');
        $this->addSql('CREATE INDEX IDX_534E688012469DE2 ON work (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE workfile');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E68809D86650F');
        $this->addSql('ALTER TABLE work DROP FOREIGN KEY FK_534E688012469DE2');
        $this->addSql('DROP INDEX UNIQ_534E68809D86650F ON work');
        $this->addSql('DROP INDEX IDX_534E688012469DE2 ON work');
        $this->addSql('ALTER TABLE work ADD file_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD file_original_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD file_mime_type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD file_dimensions LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:simple_array)\', DROP category_id, CHANGE user_id_id file_size INT DEFAULT NULL');
    }

    public function isTransactional(): bool
    {
        return false;
    }
}
