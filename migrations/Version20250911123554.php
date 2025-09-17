<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250911123554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950157D6BFD');
        $this->addSql('DROP INDEX UNIQ_1DD39950157D6BFD ON news');
        $this->addSql('ALTER TABLE news DROP newspics_id');
        $this->addSql('ALTER TABLE newspics ADD news_id INT NOT NULL');
        $this->addSql('ALTER TABLE newspics ADD CONSTRAINT FK_7A7DE115B5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
        $this->addSql('CREATE INDEX IDX_7A7DE115B5A459A0 ON newspics (news_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news ADD newspics_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950157D6BFD FOREIGN KEY (newspics_id) REFERENCES newspics (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DD39950157D6BFD ON news (newspics_id)');
        $this->addSql('ALTER TABLE newspics DROP FOREIGN KEY FK_7A7DE115B5A459A0');
        $this->addSql('DROP INDEX IDX_7A7DE115B5A459A0 ON newspics');
        $this->addSql('ALTER TABLE newspics DROP news_id');
    }
}
