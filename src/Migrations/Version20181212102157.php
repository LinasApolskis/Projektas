<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212102157 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(3) NOT NULL, alpha_code VARCHAR(3) NOT NULL, numeric_code INT NOT NULL, name VARCHAR(255) NOT NULL, rate DOUBLE PRECISION NOT NULL, date VARCHAR(255) NOT NULL, inverse_rate DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE price price INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E19D9AD25E237E06 ON service (name)');
        $this->addSql('DROP INDEX UNIQ_773DE69DE4276C68 ON car');
        $this->addSql('ALTER TABLE car CHANGE licencenumber licencenumber VARCHAR(255) NOT NULL, CHANGE brand brand VARCHAR(255) NOT NULL, CHANGE model model VARCHAR(255) NOT NULL, CHANGE year year DATE DEFAULT NULL, CHANGE gearbox gearbox VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_D95AB4059D86650F ON user_profile');
        $this->addSql('ALTER TABLE user_profile CHANGE user_id_id user_id_id INT NOT NULL, CHANGE city city VARCHAR(25) NOT NULL, CHANGE address address VARCHAR(25) NOT NULL, CHANGE phone phone VARCHAR(25) NOT NULL, CHANGE name name VARCHAR(25) NOT NULL, CHANGE surname surname VARCHAR(25) NOT NULL, ADD PRIMARY KEY (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE currency');
        $this->addSql('ALTER TABLE car CHANGE licencenumber licencenumber VARCHAR(25) NOT NULL COLLATE latin1_swedish_ci, CHANGE brand brand VARCHAR(25) NOT NULL COLLATE latin1_swedish_ci, CHANGE model model VARCHAR(25) NOT NULL COLLATE latin1_swedish_ci, CHANGE year year INT NOT NULL, CHANGE gearbox gearbox VARCHAR(25) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_773DE69DE4276C68 ON car (licencenumber)');
        $this->addSql('DROP INDEX UNIQ_E19D9AD25E237E06 ON service');
        $this->addSql('ALTER TABLE service CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE username username VARCHAR(25) NOT NULL COLLATE latin1_swedish_ci, CHANGE password password VARCHAR(64) NOT NULL COLLATE latin1_swedish_ci, CHANGE email email VARCHAR(254) NOT NULL COLLATE latin1_swedish_ci, CHANGE roles roles VARCHAR(255) NOT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE user_profile DROP INDEX primary, ADD UNIQUE INDEX UNIQ_D95AB4059D86650F (user_id_id)');
        $this->addSql('ALTER TABLE user_profile CHANGE user_id_id user_id_id INT DEFAULT NULL, CHANGE city city VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE address address VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE phone phone VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE name name VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE surname surname VARCHAR(25) DEFAULT NULL COLLATE latin1_swedish_ci');
    }
}
