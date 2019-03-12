<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190312090907 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE competence_offre (competence_id INT NOT NULL, offre_id INT NOT NULL, INDEX IDX_25A4D78915761DAB (competence_id), INDEX IDX_25A4D7894CC8505A (offre_id), PRIMARY KEY(competence_id, offre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_offre ADD CONSTRAINT FK_25A4D78915761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_offre ADD CONSTRAINT FK_25A4D7894CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE candidature ADD candidature_id_id INT DEFAULT NULL, DROP offre_id');
        $this->addSql('ALTER TABLE candidature ADD CONSTRAINT FK_E33BD3B8413EF703 FOREIGN KEY (candidature_id_id) REFERENCES offre (id)');
        $this->addSql('CREATE INDEX IDX_E33BD3B8413EF703 ON candidature (candidature_id_id)');
        $this->addSql('ALTER TABLE offre ADD contrat_id_id INT DEFAULT NULL, ADD job_id_id INT DEFAULT NULL, DROP candidature_id');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F8506F791 FOREIGN KEY (contrat_id_id) REFERENCES contrat (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F7E182327 FOREIGN KEY (job_id_id) REFERENCES job (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F8506F791 ON offre (contrat_id_id)');
        $this->addSql('CREATE INDEX IDX_AF86866F7E182327 ON offre (job_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE competence_offre');
        $this->addSql('ALTER TABLE candidature DROP FOREIGN KEY FK_E33BD3B8413EF703');
        $this->addSql('DROP INDEX IDX_E33BD3B8413EF703 ON candidature');
        $this->addSql('ALTER TABLE candidature ADD offre_id VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP candidature_id_id');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F8506F791');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F7E182327');
        $this->addSql('DROP INDEX IDX_AF86866F8506F791 ON offre');
        $this->addSql('DROP INDEX IDX_AF86866F7E182327 ON offre');
        $this->addSql('ALTER TABLE offre ADD candidature_id VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP contrat_id_id, DROP job_id_id');
    }
}
