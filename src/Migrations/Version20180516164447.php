<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180516164447 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, licencenumber VARCHAR(25) NOT NULL, brand VARCHAR(25) NOT NULL, model VARCHAR(25) NOT NULL, year INT NOT NULL, body VARCHAR(25) NOT NULL, fuel VARCHAR(25) NOT NULL, engine VARCHAR(25) NOT NULL, power INT NOT NULL, gearbox VARCHAR(25) NOT NULL, mileage INT NOT NULL, serviced TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_773DE69DE4276C68 (licencenumber), INDEX IDX_773DE69DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_service (car_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_B236610EC3C6F69F (car_id), INDEX IDX_B236610EED5CA9E6 (service_id), PRIMARY KEY(car_id, service_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(254) NOT NULL, is_active TINYINT(1) NOT NULL, roles JSON NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_profile (user_id_id INT NOT NULL, city VARCHAR(25) NOT NULL, address VARCHAR(25) NOT NULL, phone VARCHAR(25) NOT NULL, name VARCHAR(25) NOT NULL, surname VARCHAR(25) NOT NULL, PRIMARY KEY(user_id_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visit (id INT AUTO_INCREMENT NOT NULL, car_id_id INT NOT NULL, user_id_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_437EE939A0EF1B80 (car_id_id), INDEX IDX_437EE9399D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE car_service ADD CONSTRAINT FK_B236610EC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_service ADD CONSTRAINT FK_B236610EED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_profile ADD CONSTRAINT FK_D95AB4059D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939A0EF1B80 FOREIGN KEY (car_id_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE9399D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE car_service DROP FOREIGN KEY FK_B236610EC3C6F69F');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939A0EF1B80');
        $this->addSql('ALTER TABLE car_service DROP FOREIGN KEY FK_B236610EED5CA9E6');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DA76ED395');
        $this->addSql('ALTER TABLE user_profile DROP FOREIGN KEY FK_D95AB4059D86650F');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE9399D86650F');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE car_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_profile');
        $this->addSql('DROP TABLE visit');
    }
}
