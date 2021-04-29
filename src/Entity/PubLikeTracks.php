<?php

namespace App\Entity;

use App\Repository\PubLikeTracksRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PubLikeTracksRepository::class)
 */
class PubLikeTracks
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_user;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_pub;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
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
}
