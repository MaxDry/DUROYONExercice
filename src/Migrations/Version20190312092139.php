<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312092139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8413EF703');
        $this->addSql('DROP INDEX IDX_E33BD3B8413EF703 ON candidature');
        $this->addSql('ALTER TABLE candidature CHANGE candidature_id_id offre_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8286E79CC FOREIGN KEY (offre_id_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8286E79CC ON candidature (offre_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8286E79CC');
        $this->addSql('DROP INDEX IDX_E33BD3B8286E79CC ON candidature');
        $this->addSql('ALTER TABLE candidature CHANGE offre_id_id candidature_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8413EF703 FOREIGN KEY (candidature_id_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8413EF703 ON candidature (candidature_id_id)');
    }
}
