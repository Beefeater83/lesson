<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410183356 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            CREATE TABLE tag_to_blog (blog_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_15CA6D26DAE07E97 (blog_id), PRIMARY KEY(blog_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag_to_blog ADD CONSTRAINT FK_15CA6D26DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag_to_blog ADD CONSTRAINT FK_15CA6D26BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE tag_to_blog DROP FOREIGN KEY FK_15CA6D26DAE07E97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE tag_to_blog DROP FOREIGN KEY FK_15CA6D26BAD26311
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag_to_blog
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE tag
        SQL);
    }
}
