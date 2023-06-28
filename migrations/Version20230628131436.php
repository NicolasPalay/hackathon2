<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628131436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device ADD storage_id INT DEFAULT NULL, ADD size_screen_id INT DEFAULT NULL, ADD camera_id INT DEFAULT NULL, ADD state_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E5CC5DB90 FOREIGN KEY (storage_id) REFERENCES storage (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68ECE9DD249 FOREIGN KEY (size_screen_id) REFERENCES size_screen (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EB47685CD FOREIGN KEY (camera_id) REFERENCES camera (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E5D83CC1 FOREIGN KEY (state_id) REFERENCES state (id)');
        $this->addSql('CREATE INDEX IDX_92FB68E5CC5DB90 ON device (storage_id)');
        $this->addSql('CREATE INDEX IDX_92FB68ECE9DD249 ON device (size_screen_id)');
        $this->addSql('CREATE INDEX IDX_92FB68EB47685CD ON device (camera_id)');
        $this->addSql('CREATE INDEX IDX_92FB68E5D83CC1 ON device (state_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E5CC5DB90');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68ECE9DD249');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EB47685CD');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E5D83CC1');
        $this->addSql('DROP INDEX IDX_92FB68E5CC5DB90 ON device');
        $this->addSql('DROP INDEX IDX_92FB68ECE9DD249 ON device');
        $this->addSql('DROP INDEX IDX_92FB68EB47685CD ON device');
        $this->addSql('DROP INDEX IDX_92FB68E5D83CC1 ON device');
        $this->addSql('ALTER TABLE device DROP storage_id, DROP size_screen_id, DROP camera_id, DROP state_id');
    }
}
