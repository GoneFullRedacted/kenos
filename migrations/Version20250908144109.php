<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250908144109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news ADD users_id INT DEFAULT NULL, ADD newspics_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD3995067B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD39950157D6BFD FOREIGN KEY (newspics_id) REFERENCES newspics (id)');
        $this->addSql('CREATE INDEX IDX_1DD3995067B3B43D ON news (users_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1DD39950157D6BFD ON news (newspics_id)');
        $this->addSql('ALTER TABLE postcomments ADD posts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE postcomments ADD CONSTRAINT FK_163EC064D5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_163EC064D5E258C5 ON postcomments (posts_id)');
        $this->addSql('ALTER TABLE posts ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE posts ADD CONSTRAINT FK_885DBAFAA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_885DBAFAA76ED395 ON posts (user_id)');
        $this->addSql('ALTER TABLE postspics ADD posts_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE postspics ADD CONSTRAINT FK_47C532C3D5E258C5 FOREIGN KEY (posts_id) REFERENCES posts (id)');
        $this->addSql('CREATE INDEX IDX_47C532C3D5E258C5 ON postspics (posts_id)');
        $this->addSql('ALTER TABLE users ADD locations_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9ED775E23 FOREIGN KEY (locations_id) REFERENCES locations (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9ED775E23 ON users (locations_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD3995067B3B43D');
        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD39950157D6BFD');
        $this->addSql('DROP INDEX IDX_1DD3995067B3B43D ON news');
        $this->addSql('DROP INDEX UNIQ_1DD39950157D6BFD ON news');
        $this->addSql('ALTER TABLE news DROP users_id, DROP newspics_id');
        $this->addSql('ALTER TABLE postcomments DROP FOREIGN KEY FK_163EC064D5E258C5');
        $this->addSql('DROP INDEX IDX_163EC064D5E258C5 ON postcomments');
        $this->addSql('ALTER TABLE postcomments DROP posts_id');
        $this->addSql('ALTER TABLE posts DROP FOREIGN KEY FK_885DBAFAA76ED395');
        $this->addSql('DROP INDEX IDX_885DBAFAA76ED395 ON posts');
        $this->addSql('ALTER TABLE posts DROP user_id');
        $this->addSql('ALTER TABLE postspics DROP FOREIGN KEY FK_47C532C3D5E258C5');
        $this->addSql('DROP INDEX IDX_47C532C3D5E258C5 ON postspics');
        $this->addSql('ALTER TABLE postspics DROP posts_id');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9ED775E23');
        $this->addSql('DROP INDEX IDX_1483A5E9ED775E23 ON users');
        $this->addSql('ALTER TABLE users DROP locations_id');
    }
}
