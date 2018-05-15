<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180511094445 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
        $this->addSql('DROP INDEX UNIQ_D95AB4059D86650F ON user_profile');
        $this->addSql('ALTER TABLE user_profile CHANGE user_id_id user_id_id INT NOT NULL, CHANGE city city VARCHAR(25) NOT NULL, CHANGE address address VARCHAR(25) NOT NULL, CHANGE phone phone VARCHAR(25) NOT NULL, CHANGE name name VARCHAR(25) NOT NULL, CHANGE surname surname VARCHAR(25) NOT NULL, ADD PRIMARY KEY (user_id_id)');
        $this->addSql('ALTER TABLE car ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DA76ED395 ON car (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('DROP INDEX IDX_773DE69DA76ED395 ON car');
        $this->addSql('ALTER TABLE car DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE user_profile DROP INDEX primary, ADD UNIQUE INDEX UNIQ_D95AB4059D86650F (user_id_id)');
        $this->addSql('ALTER TABLE user_profile CHANGE user_id_id user_id_id INT DEFAULT NULL, CHANGE city city VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE address address VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE phone phone VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE name name VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE surname surname VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci');
    }
}
