<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250908145758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE postcomments ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE postcomments ADD CONSTRAINT FK_163EC06469CCBE9A FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_163EC06469CCBE9A ON postcomments (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE postcomments DROP FOREIGN KEY FK_163EC06469CCBE9A');
        $this->addSql('DROP INDEX IDX_163EC06469CCBE9A ON postcomments');
        $this->addSql('ALTER TABLE postcomments DROP author_id');
    }
}
