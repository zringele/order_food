<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181111151101 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE dish (id INT AUTO_INCREMENT NOT NULL, meal_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_957D8CB8639666D6 (meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dish_has_side (id INT AUTO_INCREMENT NOT NULL, dish_id INT NOT NULL, type VARCHAR(20) NOT NULL, count INT NOT NULL, INDEX IDX_67214181148EB0CB (dish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feed (id INT AUTO_INCREMENT NOT NULL, date_from DATE NOT NULL, date_to DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, name VARCHAR(20) NOT NULL, INDEX IDX_9EF68E9CCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, feed_id INT NOT NULL, day VARCHAR(20) NOT NULL, date DATE NOT NULL, INDEX IDX_7D053A9351A5BC03 (feed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, feed_id INT DEFAULT NULL, INDEX IDX_F5299398A76ED395 (user_id), INDEX IDX_F529939851A5BC03 (feed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered_dish (id INT AUTO_INCREMENT NOT NULL, order_id_id INT DEFAULT NULL, dish_id INT DEFAULT NULL, INDEX IDX_E3410D98FCDAEAAA (order_id_id), INDEX IDX_E3410D98148EB0CB (dish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selected_side (id INT AUTO_INCREMENT NOT NULL, side_dish_id INT NOT NULL, ordered_dish_id INT NOT NULL, INDEX IDX_6A2216ADC884D3E8 (side_dish_id), INDEX IDX_6A2216AD213423D0 (ordered_dish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE side_dish (id INT AUTO_INCREMENT NOT NULL, menu_id INT NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(20) NOT NULL, INDEX IDX_C939AD8FCCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(55) NOT NULL, is_admin TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dish ADD CONSTRAINT FK_957D8CB8639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('ALTER TABLE dish_has_side ADD CONSTRAINT FK_67214181148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9351A5BC03 FOREIGN KEY (feed_id) REFERENCES feed (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939851A5BC03 FOREIGN KEY (feed_id) REFERENCES feed (id)');
        $this->addSql('ALTER TABLE ordered_dish ADD CONSTRAINT FK_E3410D98FCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE ordered_dish ADD CONSTRAINT FK_E3410D98148EB0CB FOREIGN KEY (dish_id) REFERENCES dish (id)');
        $this->addSql('ALTER TABLE selected_side ADD CONSTRAINT FK_6A2216ADC884D3E8 FOREIGN KEY (side_dish_id) REFERENCES side_dish (id)');
        $this->addSql('ALTER TABLE selected_side ADD CONSTRAINT FK_6A2216AD213423D0 FOREIGN KEY (ordered_dish_id) REFERENCES ordered_dish (id)');
        $this->addSql('ALTER TABLE side_dish ADD CONSTRAINT FK_C939AD8FCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE dish_has_side DROP FOREIGN KEY FK_67214181148EB0CB');
        $this->addSql('ALTER TABLE ordered_dish DROP FOREIGN KEY FK_E3410D98148EB0CB');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9351A5BC03');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F529939851A5BC03');
        $this->addSql('ALTER TABLE dish DROP FOREIGN KEY FK_957D8CB8639666D6');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CCCD7E912');
        $this->addSql('ALTER TABLE side_dish DROP FOREIGN KEY FK_C939AD8FCCD7E912');
        $this->addSql('ALTER TABLE ordered_dish DROP FOREIGN KEY FK_E3410D98FCDAEAAA');
        $this->addSql('ALTER TABLE selected_side DROP FOREIGN KEY FK_6A2216AD213423D0');
        $this->addSql('ALTER TABLE selected_side DROP FOREIGN KEY FK_6A2216ADC884D3E8');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398A76ED395');
        $this->addSql('DROP TABLE dish');
        $this->addSql('DROP TABLE dish_has_side');
        $this->addSql('DROP TABLE feed');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE ordered_dish');
        $this->addSql('DROP TABLE selected_side');
        $this->addSql('DROP TABLE side_dish');
        $this->addSql('DROP TABLE user');
    }
}
