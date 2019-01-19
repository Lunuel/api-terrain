<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204100936 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE product');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B02345E237E06 ON city (name)');
        $this->addSql('CREATE INDEX IDX_2D5B0234BE3DB2B7 ON city (prestataire_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4BA3D9E85E237E06 ON sector (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, quantite INT NOT NULL, description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234BE3DB2B7');
        $this->addSql('DROP INDEX UNIQ_2D5B02345E237E06 ON city');
        $this->addSql('DROP INDEX IDX_2D5B0234BE3DB2B7 ON city');
        $this->addSql('DROP INDEX UNIQ_4BA3D9E85E237E06 ON sector');
    }
}
