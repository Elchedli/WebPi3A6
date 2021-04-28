<?php

namespace App\Entity;
use DateTime;
use DateTimeInterface;
use App\Repository\SuiviRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Suivi
 *
 * @ORM\Table(name="suivi", indexes={@ORM\Index(name="fk_simple_client", columns={"client"}), @ORM\Index(name="fk_psycho_username", columns={"username"})})
 * @ORM\Entity(repositoryClass=SuiviRepository::class)
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
     * @Assert\NotBlank(message="Titre obligatoire")
     * @Assert\Length(
     *      max = 40,
     *      maxMessage = "Vous avez depasser les 40 caracteres"
     * )
     * @ORM\Column(name="titre_s", type="string", length=50, nullable=false)
     */
    private $titreS;
    /**
     * @var DateTime
     * @Assert\NotBlank(message="Date obligatoire")
     * @ORM\Column(name="date_ds", type="date", nullable=false)
     */
    private $dateDs;
    /**
     * @var DateTime
     * @Assert\NotBlank(message="Date obligatoire")
     * @ORM\Column(name="date_fs", type="date", nullable=false)
     */
    private $dateFs;

    /**
     * @var DateTime
     * @Assert\NotBlank(message="Date est obligatoire")
     * @ORM\Column(name="temps_ds", type="time", nullable=false)
     */
    private $tempsDs;

    /**
     * @var DateTime
     * @Assert\NotBlank(message="Temps est obligatoire")
     * @ORM\Column(name="temps_fs", type="time", nullable=false)
     */
    private $tempsFs;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Temps est obligatoire")
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     * @ORM\ManyToOne(targetEntity=Psycho::class,inversedBy="username")
     */
    private $username;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Client obligatoire")
     * @ORM\Column(name="client", type="string", length=20, nullable=false)
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


}
