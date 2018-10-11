<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180914130133 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person_amis DROP FOREIGN KEY FK_1504634A217BBB47');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, author VARCHAR(255) NOT NULL, content VARCHAR(255) NOT NULL, createat VARCHAR(255) NOT NULL, creatat DATETIME NOT NULL, INDEX IDX_9474526C7294869C (article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE person_amis');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, age VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, famille VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, race VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nourriture VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, userid VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person_amis (person_id INT NOT NULL, amis_id INT NOT NULL, INDEX IDX_1504634A217BBB47 (person_id), INDEX IDX_1504634A706F82C7 (amis_id), PRIMARY KEY(person_id, amis_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_amis ADD CONSTRAINT FK_1504634A217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_amis ADD CONSTRAINT FK_1504634A706F82C7 FOREIGN KEY (amis_id) REFERENCES amis (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE comment');
    }
}
