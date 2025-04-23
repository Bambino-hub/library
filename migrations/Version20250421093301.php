<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421093301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE admin_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_AD8A54A9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, date_of_birth DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', date_of_death DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', nationality VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, editor_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, isbn VARCHAR(255) NOT NULL, cover VARCHAR(255) NOT NULL, edited_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', plot VARCHAR(255) NOT NULL, page_number INT NOT NULL, status LONGTEXT NOT NULL COMMENT '(DC2Type:simple_array)', INDEX IDX_CBE5A331F675F31B (author_id), INDEX IDX_CBE5A3316995AC4C (editor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE book_comment (book_id INT NOT NULL, comment_id INT NOT NULL, INDEX IDX_7547AFA16A2B381 (book_id), INDEX IDX_7547AFAF8697D13 (comment_id), PRIMARY KEY(book_id, comment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', publishe_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', content LONGTEXT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE editor (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_8D93D64983A00E68 (firstname), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book ADD CONSTRAINT FK_CBE5A3316995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_comment ADD CONSTRAINT FK_7547AFA16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_comment ADD CONSTRAINT FK_7547AFAF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331F675F31B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3316995AC4C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_comment DROP FOREIGN KEY FK_7547AFA16A2B381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_comment DROP FOREIGN KEY FK_7547AFAF8697D13
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE admin_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE author
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE book
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE book_comment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE comment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE editor
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
