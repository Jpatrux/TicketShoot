<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516131915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE seance ADD CONSTRAINT FK_DF7DFD0EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DF7DFD0EA76ED395 ON seance (user_id)');
        $this->addSql('ALTER TABLE user ADD equipe_id INT DEFAULT NULL, ADD poste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6496D861B89 ON user (equipe_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A0905086 ON user (poste_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE seance DROP FOREIGN KEY FK_DF7DFD0EA76ED395');
        $this->addSql('DROP INDEX IDX_DF7DFD0EA76ED395 ON seance');
        $this->addSql('ALTER TABLE seance DROP user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496D861B89');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A0905086');
        $this->addSql('DROP INDEX IDX_8D93D6496D861B89 ON user');
        $this->addSql('DROP INDEX IDX_8D93D649A0905086 ON user');
        $this->addSql('ALTER TABLE user DROP equipe_id, DROP poste_id');
    }
}
