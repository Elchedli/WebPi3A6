<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Invitation
 *
 * @ORM\Table(name="invitation")
 * @ORM\Entity
 */
class Invitation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     *@var Simple
     * @ORM\ManyToOne(targetEntity="\App\Entity\Simple", inversedBy="Simple")
     *@ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     * })
     */
    private $idUser;

    /**
     * @var Evenement
     * @ORM\ManyToOne(targetEntity="\App\Entity\Evenement", inversedBy="Evenement")
     * ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_ev", referencedColumnName="id_ev")
     * })
     */
    private $idEv;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?Simple
    {
        return $this->idUser;
    }

    public function setIdUser(?Simple $idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }

    public function getIdEv(): ?Evenement
    {
        return $this->idEv;
    }

    public function setIdEv(?Evenement $idEv): self
    {
        $this->idEv = $idEv;
        return $this;
    }

}
