<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation", indexes={@ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_cat", columns={"id_cat"})})
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_rec", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRec;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obj_rec", type="string", length=50, nullable=true)
     * @Assert\NotBlank(message="This field is obligatory.")
     * @Assert\Type(
     *     type="alpha",
     *     message="Please fill it with letters only."
     * )
     */
    private $objRec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="suj_rec", type="string", length=150, nullable=true)
     * @Assert\NotBlank(message="This field is obligatory.")
     *
     */
    private $sujRec;

    /**
     * @var string|null
     *
     * @ORM\Column(name="etat_rec", type="string", length=20, nullable=true, options={"default"="To do"})
     */
    private $etatRec = 'To do';

    /**
     * @var DateTime|null
     *
     * @ORM\Column(name="date_rec", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateRec ;


    /**
     * @var \App\Entity\Categories
     *
     * @ORM\ManyToOne(targetEntity=Categories::class, inversedBy="reclamations")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_cat", referencedColumnName="id_cat")
     * })
     * @Assert\NotNull(message="This field is obligatory.")
     */
    private $idCat;

    /**
     * @return int
     */
    public function getIdRec(): int
    {
        return $this->idRec;
    }

    /**
     * @param int $idRec
     */
    public function setIdRec(int $idRec): void
    {
        $this->idRec = $idRec;
    }

    /**
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getObjRec(): ?string
    {
        return $this->objRec;
    }

    /**
     * @param string|null $objRec
     */
    public function setObjRec(?string $objRec): void
    {
        $this->objRec = $objRec;
    }

    /**
     * @return string|null
     */
    public function getSujRec(): ?string
    {
        return $this->sujRec;
    }

    /**
     * @param string|null $sujRec
     */
    public function setSujRec(?string $sujRec): void
    {
        $this->sujRec = $sujRec;
    }

    /**
     * @return string|null
     */
    public function getEtatRec(): ?string
    {
        return $this->etatRec;
    }

    /**
     * @param string|null $etatRec
     */
    public function setEtatRec(?string $etatRec): void
    {
        $this->etatRec = $etatRec;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateRec(): ?DateTimeInterface
    {
        return $this->dateRec;
    }

    /**
     * @param DateTimeInterface|null $dateRec
     */
    public function setDateRec(?DateTimeInterface $dateRec): void
    {
        $this->dateRec = $dateRec;
    }

    /**
     * @return \App\Entity\Categories
     */
    public function getIdCat(): ?\App\Entity\Categories
    {
        return $this->idCat;
    }

    /**
     * @param \App\Entity\Categories $idCat
     */
    public function setIdCat(\App\Entity\Categories $idCat): void
    {
        $this->idCat = $idCat;
    }

    public function __toString()
    {
        return $this->username;
    }


}
