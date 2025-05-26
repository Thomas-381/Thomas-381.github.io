<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522201823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ide (id SERIAL NOT NULL, nom VARCHAR(32) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ide_langage (ide_id INT NOT NULL, langage_id INT NOT NULL, PRIMARY KEY(ide_id, langage_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_53DCAD82677335AF ON ide_langage (ide_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_53DCAD82957BB53C ON ide_langage (langage_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE langage (id SERIAL NOT NULL, nom VARCHAR(32) NOT NULL, version VARCHAR(16) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE projet (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(1023) NOT NULL, duree VARCHAR(32) NOT NULL, equipe VARCHAR(16) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE projet_langage (projet_id INT NOT NULL, langage_id INT NOT NULL, PRIMARY KEY(projet_id, langage_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4E7AB757C18272 ON projet_langage (projet_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_4E7AB757957BB53C ON projet_langage (langage_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE usager (id SERIAL NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(16) DEFAULT NULL, prenom VARCHAR(16) DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME ON usager (username)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ide_langage ADD CONSTRAINT FK_53DCAD82677335AF FOREIGN KEY (ide_id) REFERENCES ide (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ide_langage ADD CONSTRAINT FK_53DCAD82957BB53C FOREIGN KEY (langage_id) REFERENCES langage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet_langage ADD CONSTRAINT FK_4E7AB757C18272 FOREIGN KEY (projet_id) REFERENCES projet (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet_langage ADD CONSTRAINT FK_4E7AB757957BB53C FOREIGN KEY (langage_id) REFERENCES langage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ide_langage DROP CONSTRAINT FK_53DCAD82677335AF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ide_langage DROP CONSTRAINT FK_53DCAD82957BB53C
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet_langage DROP CONSTRAINT FK_4E7AB757C18272
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE projet_langage DROP CONSTRAINT FK_4E7AB757957BB53C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ide
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ide_langage
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE langage
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE projet
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE projet_langage
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE usager
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
