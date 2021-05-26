<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028142203 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tweet ADD user_id INT NOT NULL, DROP author');
        $this->addSql('ALTER TABLE tweet ADD CONSTRAINT FK_3D660A3BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3D660A3BA76ED395 ON tweet (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tweet DROP FOREIGN KEY FK_3D660A3BA76ED395');
        $this->addSql('DROP INDEX IDX_3D660A3BA76ED395 ON tweet');
        $this->addSql('ALTER TABLE tweet ADD author VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP user_id');
    }
}
