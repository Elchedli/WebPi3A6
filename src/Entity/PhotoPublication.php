<?php

namespace App\Entity;

use App\Repository\PhotoPublicationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PhotoPublicationRepository::class)
 */
class PhotoPublication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_ph;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_pub;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $lien;

    public function getidPh(): ?int
    {
        return $this->id_ph;
    }
    public function getId_ph(): ?int
    {
        return $this->id_ph;
    }
    public function id_ph(): ?int
    {
        return $this->id_ph;
    }
    public function setId_ph(int $id_ph): self
    {
        return $this->id_ph = $id_ph;
    }

    public function getIdPub(): ?int
    {
        return $this->id_pub;
    }

    public function setIdPub(int $id_pub): self
    {
        $this->id_pub = $id_pub;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }
}
