<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251115180826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product_detail ADD etat VARCHAR(255) DEFAULT NULL, ADD marque VARCHAR(255) DEFAULT NULL, ADD modele VARCHAR(255) DEFAULT NULL, ADD processeur VARCHAR(255) DEFAULT NULL, ADD stockage VARCHAR(255) DEFAULT NULL, ADD carte_graphique VARCHAR(255) DEFAULT NULL, ADD os_installe VARCHAR(255) DEFAULT NULL, ADD taille_ecran VARCHAR(255) DEFAULT NULL, ADD resolution VARCHAR(255) DEFAULT NULL, ADD claviers VARCHAR(255) DEFAULT NULL, ADD webcam VARCHAR(255) DEFAULT NULL, ADD connexion_wifi VARCHAR(255) DEFAULT NULL, ADD lecteur_option VARCHAR(255) DEFAULT NULL, ADD ports VARCHAR(255) DEFAULT NULL, ADD dimension VARCHAR(255) DEFAULT NULL, ADD poids VARCHAR(255) DEFAULT NULL, ADD fournis_avec VARCHAR(255) DEFAULT NULL, DROP brand, DROP model, DROP processor, DROP storage, DROP screen, DROP battery, DROP os, DROP connectivity, DROP color, DROP weight, DROP additional_info
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE product_detail ADD brand VARCHAR(255) DEFAULT NULL, ADD model VARCHAR(255) DEFAULT NULL, ADD processor VARCHAR(255) DEFAULT NULL, ADD storage VARCHAR(255) DEFAULT NULL, ADD screen VARCHAR(255) DEFAULT NULL, ADD battery VARCHAR(255) DEFAULT NULL, ADD os VARCHAR(255) DEFAULT NULL, ADD connectivity VARCHAR(255) DEFAULT NULL, ADD color VARCHAR(255) DEFAULT NULL, ADD weight VARCHAR(255) DEFAULT NULL, ADD additional_info VARCHAR(255) DEFAULT NULL, DROP etat, DROP marque, DROP modele, DROP processeur, DROP stockage, DROP carte_graphique, DROP os_installe, DROP taille_ecran, DROP resolution, DROP claviers, DROP webcam, DROP connexion_wifi, DROP lecteur_option, DROP ports, DROP dimension, DROP poids, DROP fournis_avec
        SQL);
    }
}
