<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180912022833 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE person_amis (person_id INT NOT NULL, amis_id INT NOT NULL, INDEX IDX_1504634A217BBB47 (person_id), INDEX IDX_1504634A706F82C7 (amis_id), PRIMARY KEY(person_id, amis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE person_amis ADD CONSTRAINT FK_1504634A217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE person_amis ADD CONSTRAINT FK_1504634A706F82C7 FOREIGN KEY (amis_id) REFERENCES amis (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE amis_person');
        $this->addSql('ALTER TABLE person ADD userid VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amis_person (amis_id INT NOT NULL, person_id INT NOT NULL, INDEX IDX_5C583FD3706F82C7 (amis_id), INDEX IDX_5C583FD3217BBB47 (person_id), PRIMARY KEY(amis_id, person_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amis_person ADD CONSTRAINT FK_5C583FD3217BBB47 FOREIGN KEY (person_id) REFERENCES person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE amis_person ADD CONSTRAINT FK_5C583FD3706F82C7 FOREIGN KEY (amis_id) REFERENCES amis (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE person_amis');
        $this->addSql('ALTER TABLE person DROP userid');
    }
}
