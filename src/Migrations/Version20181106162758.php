<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181106162758 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE selected_side (id INT AUTO_INCREMENT NOT NULL, side_dish_id INT NOT NULL, ordered_dish_id INT NOT NULL, INDEX IDX_6A2216ADC884D3E8 (side_dish_id), INDEX IDX_6A2216AD213423D0 (ordered_dish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE selected_side ADD CONSTRAINT FK_6A2216ADC884D3E8 FOREIGN KEY (side_dish_id) REFERENCES side_dish (id)');
        $this->addSql('ALTER TABLE selected_side ADD CONSTRAINT FK_6A2216AD213423D0 FOREIGN KEY (ordered_dish_id) REFERENCES ordered_dish (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE selected_side');
    }
}
