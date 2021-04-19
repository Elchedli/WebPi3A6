<?php

namespace App\Entity;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Suivi
 *
 * @ORM\Table(name="suivi", indexes={@ORM\Index(name="fk_simple_client", columns={"client"}), @ORM\Index(name="fk_psycho_username", columns={"username"})})
 * @ORM\Entity
 */
class Suivi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_s", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idS;

    /**
     * @var string|null
     * @ORM\Column(name="titre_s", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message=" Adresse devrait etre non vide")
     */
    private $titreS;

    /**
     * @var DateTime
     * @ORM\Column(name="date_ds", type="date", nullable=false)
     * @Assert\DateTime(message="Faut que ca soit une date valide")
     */
    private $dateDs;

    /**
     * @var DateTime
     * @ORM\Column(name="date_fs", type="date", nullable=false)
     * @Assert\DateTime(message="Faut que ca soit une date valide")
     */
    private $dateFs;

    /**
     * @var DateTime
     * @ORM\Column(name="temps_ds", type="time", nullable=false)
     * @Assert\DateTime(message="Faut que ca soit du temps")
     */
    private $tempsDs;

    /**
     * @var DateTime
     * @ORM\Column(name="temps_fs", type="time", nullable=false)
     * @Assert\DateTime(message="Faut que ca soit du temps")
     */
    private $tempsFs;

    /**
     * @var string|null
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     * @ORM\ManyToOne(targetEntity=Psycho::class,inversedBy="username")
     */
    private $username;

    /**
     * @var String|null
     * @ORM\Column(name="client", type="string", length=20, nullable=false)
     * @Assert\NotBlank(message="Client doit étre existant")
     * @ORM\ManyToOne(targetEntity=Simple::class,inversedBy="username")
     */
    private $client;

    /**
     * @return int
     */
    public function getIdS(): int
    {
        return $this->idS;
    }

    /**
     * @param int $idS
     */
    public function setIdS(int $idS): void
    {
        $this->idS = $idS;
    }

    /**
     * @return string|null
     */
    public function getTitreS(): ?string
    {
        return $this->titreS;
    }

    /**
     * @param string|null $titreS
     */
    public function setTitreS(?string $titreS): void
    {
        $this->titreS = $titreS;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDateDs(): ?DateTimeInterface
    {
        return $this->dateDs;
    }

    /**
     * @param DateTimeInterface $dateDs
     */
    public function setDateDs(DateTimeInterface $dateDs): void
    {
        $this->dateDs = $dateDs;
    }


    public function getDateFs(): ?DateTimeInterface
    {
        return $this->dateFs;
    }


    public function setDateFs(DateTimeInterface $dateFs): void
    {
        $this->dateFs = $dateFs;
    }

    public function getTempsDs(): ?DateTimeInterface
    {
        return $this->tempsDs;
    }

    public function setTempsDs(DateTimeInterface $tempsDs): void
    {
        $this->tempsDs = $tempsDs;
    }

    public function getTempsFs(): ?DateTimeInterface
    {
        return $this->tempsFs;
    }

    public function setTempsFs(DateTimeInterface $tempsFs): void
    {
        $this->tempsFs = $tempsFs;
    }

    /**
     * @return String
     */
    public function getUsername(): String
    {
        return $this->username;
    }

    /**
     * @param String $username
     */
    public function setUsername(String $username): void
    {
        $this->username = $username;
    }

    /**
     * @return String
     */
    public function getClient(): String
    {
        return $this->client;
    }

    /**
     * @param String $client
     */
    public function setClient(String $client): void
    {
        $this->client = $client;
    }

    public function __toString() {
        return $this->getUsername();
    }
}
