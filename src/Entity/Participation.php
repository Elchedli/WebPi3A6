<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_par_user", columns={"id_user"}), @ORM\Index(name="fk_par_event", columns={"id_event"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_par", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPar;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     */
    private $idEvent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbr_par", type="integer", nullable=true)
     */
    private $nbrPar = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_par", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datePar = 'CURRENT_TIMESTAMP';

    public function getIdPar(): ?int
    {
        return $this->idPar;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdEvent(): ?int
    {
        return $this->idEvent;
    }

    public function setIdEvent(int $idEvent): self
    {
        $this->idEvent = $idEvent;

        return $this;
    }

    public function getNbrPar(): ?int
    {
        return $this->nbrPar;
    }

    public function setNbrPar(?int $nbrPar): self
    {
        $this->nbrPar = $nbrPar;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getDatePar(): ?\DateTimeInterface
    {
        return $this->datePar;
    }

    public function setDatePar(\DateTimeInterface $datePar): self
    {
        $this->datePar = $datePar;

        return $this;
    }


}
