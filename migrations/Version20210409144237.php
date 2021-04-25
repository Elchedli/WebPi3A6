<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210409144237 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY fk_art_cat');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY fk_event');
        $this->addSql('ALTER TABLE photo_publications DROP FOREIGN KEY fk_pub');
        $this->addSql('ALTER TABLE pub_like_tracks DROP FOREIGN KEY FK_pub_likes');
        $this->addSql('ALTER TABLE tag_publication DROP FOREIGN KEY FK_pub_rel');
        $this->addSql('ALTER TABLE tag_publication DROP FOREIGN KEY FK_tag_rel');
        $this->addSql('DROP TABLE act');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE coach');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE invitation');
        $this->addSql('DROP TABLE nutri');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE photo_publications');
        $this->addSql('DROP TABLE psycho');
        $this->addSql('DROP TABLE pub_like_tracks');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_publication');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX username ON simple');
        $this->addSql('ALTER TABLE simple CHANGE username username VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE mail mail VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE act (id_act INT NOT NULL, nom_act VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type_act VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_act)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE admin (id_user INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE articles (id_art INT AUTO_INCREMENT NOT NULL, titre_art VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, auteur_art VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, description_art VARCHAR(1500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date_art DATETIME DEFAULT CURRENT_TIMESTAMP, likes INT DEFAULT 0, id_cat INT NOT NULL, photo VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, INDEX FK_cat_art (id_cat), PRIMARY KEY(id_art)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE categorie (id_cat INT AUTO_INCREMENT NOT NULL, titre_cat VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, UNIQUE INDEX titre_cat (titre_cat), PRIMARY KEY(id_cat)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE coach (id_user INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_n DATE NOT NULL, code VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, UNIQUE INDEX username (username), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaire (id_com INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_pub INT NOT NULL, suj_com VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date_com DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, nb_reaction INT DEFAULT 0 NOT NULL, INDEX fk_com_user (id_user), INDEX fk_com_pub (id_pub), PRIMARY KEY(id_com)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evenement (id_ev INT AUTO_INCREMENT NOT NULL, id_act INT DEFAULT NULL, titre_ev VARCHAR(80) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, type_ev VARCHAR(50) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, emplacement_ev VARCHAR(30) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, date_dev DATE NOT NULL, date_fev DATE NOT NULL, temps_dev TIME NOT NULL, temps_fev TIME NOT NULL, age_min INT DEFAULT NULL, age_max INT DEFAULT NULL, INDEX fk_art_cat (id_act), PRIMARY KEY(id_ev)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE invitation (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_ev INT NOT NULL, INDEX fk_id (id_user), INDEX fk_id_ev (id_ev), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nutri (id_user INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_n DATE NOT NULL, code VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, UNIQUE INDEX username (username), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE participation (id_par INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_event INT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, date_par DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX username (username), INDEX fk_event (id_event), INDEX fk_user_part (id_user), PRIMARY KEY(id_par)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE photo_publications (id_ph INT AUTO_INCREMENT NOT NULL, id_pub INT NOT NULL, lien VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX fk_pub (id_pub), PRIMARY KEY(id_ph)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE psycho (id_user INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_n DATE NOT NULL, code VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, UNIQUE INDEX username (username), UNIQUE INDEX username_2 (username), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pub_like_tracks (id_track INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, id_pub INT NOT NULL, INDEX FK_pub_likes (id_pub), INDEX fk_simple (id_user), PRIMARY KEY(id_track)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE publication (id_pub INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, nb_reaction INT NOT NULL, texte VARCHAR(1000) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_pub DATETIME DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id_pub)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (id_rec INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, obj_rec VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, area_rec VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, suj_rec VARCHAR(150) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, etat_rec VARCHAR(20) CHARACTER SET utf8mb4 DEFAULT \'To do\' COLLATE `utf8mb4_general_ci`, date_rec DATETIME DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(id_rec)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tag (id_tag INT AUTO_INCREMENT NOT NULL, tag VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, UNIQUE INDEX U_tag (tag), PRIMARY KEY(id_tag)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tag_publication (id_rel INT AUTO_INCREMENT NOT NULL, id_pub INT NOT NULL, id_tag INT NOT NULL, INDEX FK_pub_rel (id_pub), INDEX FK_tag_rel (id_tag), PRIMARY KEY(id_rel)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, password VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_n DATE NOT NULL, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT fk_art_cat FOREIGN KEY (id_act) REFERENCES act (id_act)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT fk_event FOREIGN KEY (id_event) REFERENCES evenement (id_ev) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT fk_user_part FOREIGN KEY (id_user) REFERENCES simple (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE photo_publications ADD CONSTRAINT fk_pub FOREIGN KEY (id_pub) REFERENCES publication (id_pub)');
        $this->addSql('ALTER TABLE pub_like_tracks ADD CONSTRAINT FK_pub_likes FOREIGN KEY (id_pub) REFERENCES publication (id_pub)');
        $this->addSql('ALTER TABLE pub_like_tracks ADD CONSTRAINT fk_simple FOREIGN KEY (id_user) REFERENCES simple (id_user)');
        $this->addSql('ALTER TABLE tag_publication ADD CONSTRAINT FK_pub_rel FOREIGN KEY (id_pub) REFERENCES publication (id_pub)');
        $this->addSql('ALTER TABLE tag_publication ADD CONSTRAINT FK_tag_rel FOREIGN KEY (id_tag) REFERENCES tag (id_tag)');
        $this->addSql('ALTER TABLE simple CHANGE username username VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE password password TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE mail mail VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('CREATE UNIQUE INDEX username ON simple (username)');
    }
}
