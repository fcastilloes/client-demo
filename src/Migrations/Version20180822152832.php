<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180822152832 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE chart_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE chart_label_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE chart (id INT NOT NULL, type VARCHAR(50) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE chart_label (id INT NOT NULL, chart_id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E896EFB4BEF83E0A ON chart_label (chart_id)');
        $this->addSql('ALTER TABLE chart_label ADD CONSTRAINT FK_E896EFB4BEF83E0A FOREIGN KEY (chart_id) REFERENCES chart (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE chart_label DROP CONSTRAINT FK_E896EFB4BEF83E0A');
        $this->addSql('DROP SEQUENCE chart_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE chart_label_id_seq CASCADE');
        $this->addSql('DROP TABLE chart');
        $this->addSql('DROP TABLE chart_label');
    }
}
