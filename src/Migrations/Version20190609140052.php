<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190609140052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, max_people INT NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, location_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, file VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, INDEX IDX_3BAE0AA7918DB72 (location_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_activity (event_id INT NOT NULL, activity_id INT NOT NULL, INDEX IDX_EA98E08A71F7E88B (event_id), INDEX IDX_EA98E08A81C06096 (activity_id), PRIMARY KEY(event_id, activity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(255) NOT NULL, street_number VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, zip VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE period (id INT AUTO_INCREMENT NOT NULL, activity_id_id INT DEFAULT NULL, place_id_id INT DEFAULT NULL, start_time TIME NOT NULL, end_time TIME NOT NULL, INDEX IDX_C5B81ECE6146A8E4 (activity_id_id), INDEX IDX_C5B81ECED6328574 (place_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, coordinates VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7918DB72 FOREIGN KEY (location_id_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE event_activity ADD CONSTRAINT FK_EA98E08A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_activity ADD CONSTRAINT FK_EA98E08A81C06096 FOREIGN KEY (activity_id) REFERENCES activity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE period ADD CONSTRAINT FK_C5B81ECE6146A8E4 FOREIGN KEY (activity_id_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE period ADD CONSTRAINT FK_C5B81ECED6328574 FOREIGN KEY (place_id_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE fos_user CHANGE last_activity_at last_activity_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_activity DROP FOREIGN KEY FK_EA98E08A81C06096');
        $this->addSql('ALTER TABLE period DROP FOREIGN KEY FK_C5B81ECE6146A8E4');
        $this->addSql('ALTER TABLE event_activity DROP FOREIGN KEY FK_EA98E08A71F7E88B');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7918DB72');
        $this->addSql('ALTER TABLE period DROP FOREIGN KEY FK_C5B81ECED6328574');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_activity');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE period');
        $this->addSql('DROP TABLE place');
        $this->addSql('ALTER TABLE fos_user CHANGE last_activity_at last_activity_at DATETIME DEFAULT NULL');
    }
}
