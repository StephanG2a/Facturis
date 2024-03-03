<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303203310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE invoice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE quote_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE invoice (id INT NOT NULL, quote_id INT DEFAULT NULL, client_id INT NOT NULL, total_price NUMERIC(10, 2) NOT NULL, tax_amount NUMERIC(10, 2) NOT NULL, status VARCHAR(255) NOT NULL, issue_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, due_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_90651744DB805178 ON invoice (quote_id)');
        $this->addSql('CREATE INDEX IDX_9065174419EB6921 ON invoice (client_id)');
        $this->addSql('CREATE TABLE invoice_service (invoice_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(invoice_id, service_id))');
        $this->addSql('CREATE INDEX IDX_1344AC012989F1FD ON invoice_service (invoice_id)');
        $this->addSql('CREATE INDEX IDX_1344AC01ED5CA9E6 ON invoice_service (service_id)');
        $this->addSql('CREATE TABLE quote (id INT NOT NULL, client_id INT NOT NULL, total_price NUMERIC(10, 2) NOT NULL, tax_rate NUMERIC(5, 2) NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, valid_until TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6B71CBF419EB6921 ON quote (client_id)');
        $this->addSql('CREATE TABLE quote_service (quote_id INT NOT NULL, service_id INT NOT NULL, PRIMARY KEY(quote_id, service_id))');
        $this->addSql('CREATE INDEX IDX_E723256DB805178 ON quote_service (quote_id)');
        $this->addSql('CREATE INDEX IDX_E723256ED5CA9E6 ON quote_service (service_id)');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_90651744DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_9065174419EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_service ADD CONSTRAINT FK_1344AC012989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE invoice_service ADD CONSTRAINT FK_1344AC01ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF419EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quote_service ADD CONSTRAINT FK_E723256ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE invoice_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE quote_id_seq CASCADE');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_90651744DB805178');
        $this->addSql('ALTER TABLE invoice DROP CONSTRAINT FK_9065174419EB6921');
        $this->addSql('ALTER TABLE invoice_service DROP CONSTRAINT FK_1344AC012989F1FD');
        $this->addSql('ALTER TABLE invoice_service DROP CONSTRAINT FK_1344AC01ED5CA9E6');
        $this->addSql('ALTER TABLE quote DROP CONSTRAINT FK_6B71CBF419EB6921');
        $this->addSql('ALTER TABLE quote_service DROP CONSTRAINT FK_E723256DB805178');
        $this->addSql('ALTER TABLE quote_service DROP CONSTRAINT FK_E723256ED5CA9E6');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('DROP TABLE invoice_service');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_service');
    }
}
