<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250410112957 extends AbstractMigration
{
    public function up(Schema $schema): void
    {

        $this->addSql(<<<'SQL'
            ALTER TABLE blog ADD category_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE blog ADD CONSTRAINT FK_C015514312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_C015514312469DE2 ON blog (category_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        $this->addSql(<<<'SQL'
            ALTER TABLE blog DROP FOREIGN KEY FK_C015514312469DE2
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_C015514312469DE2 ON blog
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE blog DROP category_id
        SQL);
    }
}
