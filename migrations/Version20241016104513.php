<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016104513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3C54C8C93 FOREIGN KEY (type_id) REFERENCES type_card (id)');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3EA000B10 FOREIGN KEY (class_id) REFERENCES class_card (id)');
        $this->addSql('CREATE INDEX IDX_161498D3EA000B10 ON card (class_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3C54C8C93');
        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3EA000B10');
        $this->addSql('DROP INDEX IDX_161498D3EA000B10 ON card');
    }
}
