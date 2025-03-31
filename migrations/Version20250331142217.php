<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331142217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, editor_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, edited_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', plot VARCHAR(255) NOT NULL, page_number INT NOT NULL, status LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_CBE5A331F675F31B (author_id), INDEX IDX_CBE5A3316995AC4C (editor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE book_comment (book_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_7547AFA16A2B381 (book_id), INDEX IDX_7547AFAF8697D13 (comment_id), PRIMARY KEY(book_id, comment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A3316995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)');
        $this->addSql('ALTER TABLE book_comment ADD CONSTRAINT FK_7547AFA16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE book_comment ADD CONSTRAINT FK_7547AFAF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX uniq_identifier_email ON admin_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AD8A54A9E7927C74 ON admin_user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3316995AC4C');
        $this->addSql('ALTER TABLE book_comment DROP FOREIGN KEY FK_7547AFA16A2B381');
        $this->addSql('ALTER TABLE book_comment DROP FOREIGN KEY FK_7547AFAF8697D13');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE book_comment');
        $this->addSql('DROP INDEX uniq_ad8a54a9e7927c74 ON admin_user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON admin_user (email)');
    }
}
