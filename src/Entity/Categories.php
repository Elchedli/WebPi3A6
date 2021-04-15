<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_cat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_cat", type="string", length=500, nullable=true)
     * @Assert\NotBlank(message="This field is obligatory")
     * @Assert\Type(
     *     type="alpha",
     *     message="Please fill it with letters only."
     * )
     */
    private $nomCat;

    /**
     * @return int
     */
    public function getIdCat(): int
    {
        return $this->idCat;
    }

    /**
     * @param int $idCat
     */
    public function setIdCat(int $idCat): void
    {
        $this->idCat = $idCat;
    }

    /**
     * @return string|null
     */
    public function getNomCat(): ?string
    {
        return $this->nomCat;
    }

    /**
     * @param string|null $nomCat
     */
    public function setNomCat(?string $nomCat): void
    {
        $this->nomCat = $nomCat;
    }

    public function __toString()
    {
       return $this->nomCat;
    }


}
