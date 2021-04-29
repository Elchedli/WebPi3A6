<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_pub;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_reaction;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\Length(min= 1, max = 255)
     */
    private $texte;

    /**
     * @ORM\Column(type="string", length=1000)
     * @Assert\Length(min= 1, max = 255)
     */
    private $username;

    public function setUsername($username)
    {
        return $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_pub;

    public $comment = [];

    public function getDate()
    {
        return $this->date_pub;
    }
    public function datePub()
    {
        return $this->date_pub;
    }
    public function getId()
    {
        return $this->id_pub;
    }
    public function getid_pub()
    {
        return $this->id_pub;
    }
    public function getTexte()
    {
        return $this->texte;
    }



    public function getId_user()
    {
        return $this->id_user;
    }
    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getNb_reaction()
    {
        return $this->nb_reaction;
    }
    public function getNbReaction()
    {
        return $this->nb_reaction;
    }


    public function setLikes($likes)
    {
        return $this->nb_reaction = $likes;
    }
    public function setId($id)
    {
        return $this->id_pub = $id;
    }
    public function setId_user($id)
    {
        return $this->id_user = $id;
    }
    public function setTexte($text)
    {
        return $this->texte = $text;
    }



    public function setDate($date)
    {
        return $this->date_pub = $date;
    }
}
