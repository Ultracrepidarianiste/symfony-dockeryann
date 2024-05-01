<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240411132139 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable('commentaire');
        if (!$table->hasColumn('article_id')) {
            $this->addSql('ALTER TABLE commentaire ADD article_id INT DEFAULT NULL');
            $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
            $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commentaire DROP CONSTRAINT FK_67F068BC7294869C');
        $this->addSql('DROP INDEX IDX_67F068BC7294869C');
        $this->addSql('ALTER TABLE commentaire DROP article_id');
    }
}
