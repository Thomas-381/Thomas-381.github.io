<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522202107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ADD description_longue VARCHAR(2047) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ALTER nom TYPE VARCHAR(32)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ALTER description TYPE VARCHAR(160)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ALTER equipe TYPE VARCHAR(32)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet DROP description_longue
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ALTER nom TYPE VARCHAR(255)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ALTER description TYPE VARCHAR(1023)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet ALTER equipe TYPE VARCHAR(16)
        SQL);
    }
}
