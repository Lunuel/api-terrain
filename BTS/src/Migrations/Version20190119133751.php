<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190119133751 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, fullname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bex CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE city CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234DE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B023492A7639E FOREIGN KEY (bex_id) REFERENCES bex (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B02345E237E06 ON city (name)');
        $this->addSql('CREATE INDEX IDX_2D5B0234DE95C867 ON city (sector_id)');
        $this->addSql('CREATE INDEX IDX_2D5B023492A7639E ON city (bex_id)');
        $this->addSql('ALTER TABLE city_prestataire ADD PRIMARY KEY (city_id, prestataire_id)');
        $this->addSql('ALTER TABLE city_prestataire ADD CONSTRAINT FK_43167A8F8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE city_prestataire ADD CONSTRAINT FK_43167A8FBE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_43167A8F8BAC62AF ON city_prestataire (city_id)');
        $this->addSql('CREATE INDEX IDX_43167A8FBE3DB2B7 ON city_prestataire (prestataire_id)');
        $this->addSql('ALTER TABLE prestataire CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE sector CHANGE id id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4BA3D9E85E237E06 ON sector (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE bex MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE bex DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE bex CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE city MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234DE95C867');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B023492A7639E');
        $this->addSql('DROP INDEX UNIQ_2D5B02345E237E06 ON city');
        $this->addSql('DROP INDEX IDX_2D5B0234DE95C867 ON city');
        $this->addSql('DROP INDEX IDX_2D5B023492A7639E ON city');
        $this->addSql('ALTER TABLE city DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE city CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE city_prestataire DROP FOREIGN KEY FK_43167A8F8BAC62AF');
        $this->addSql('ALTER TABLE city_prestataire DROP FOREIGN KEY FK_43167A8FBE3DB2B7');
        $this->addSql('DROP INDEX IDX_43167A8F8BAC62AF ON city_prestataire');
        $this->addSql('DROP INDEX IDX_43167A8FBE3DB2B7 ON city_prestataire');
        $this->addSql('ALTER TABLE city_prestataire DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE prestataire MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE prestataire DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE prestataire CHANGE id id INT NOT NULL');
        $this->addSql('ALTER TABLE sector MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_4BA3D9E85E237E06 ON sector');
        $this->addSql('ALTER TABLE sector DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE sector CHANGE id id INT NOT NULL');
    }
}
