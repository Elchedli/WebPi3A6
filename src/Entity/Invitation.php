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
     * @ORM\ManyToOne(targetEntity=Simple::class)
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id_user")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Evenement::class)
     * @ORM\JoinColumn(name="id_ev", referencedColumnName="id_ev")
     */
    private $idEv;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdEv()
    {
        return $this->idEv;
    }

    /**
     * @param mixed $idEv
     */
    public function setIdEv($idEv): void
    {
        $this->idEv = $idEv;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @param mixed $idUser
     */
    public function setIdUser($idUser): void
    {
        $this->idUser = $idUser;
    }


}
