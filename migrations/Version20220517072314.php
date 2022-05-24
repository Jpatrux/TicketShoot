<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220517072314 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sceances ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE sceances ADD CONSTRAINT FK_4126955B67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_4126955B67B3B43D ON sceances (users_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sceances DROP FOREIGN KEY FK_4126955B67B3B43D');
        $this->addSql('DROP INDEX IDX_4126955B67B3B43D ON sceances');
        $this->addSql('ALTER TABLE sceances DROP users_id');
    }
}
