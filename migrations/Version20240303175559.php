<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303175559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service DROP CONSTRAINT fk_e19d9ad2a21214b7');
        $this->addSql('DROP INDEX idx_e19d9ad2a21214b7');
        $this->addSql('ALTER TABLE service RENAME COLUMN categories_id TO category_id');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E19D9AD212469DE2 ON service (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE service DROP CONSTRAINT FK_E19D9AD212469DE2');
        $this->addSql('DROP INDEX IDX_E19D9AD212469DE2');
        $this->addSql('ALTER TABLE service RENAME COLUMN category_id TO categories_id');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT fk_e19d9ad2a21214b7 FOREIGN KEY (categories_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_e19d9ad2a21214b7 ON service (categories_id)');
    }
}
