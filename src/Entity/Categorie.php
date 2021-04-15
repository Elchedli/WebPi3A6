<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie", uniqueConstraints={@ORM\UniqueConstraint(name="titre_cat", columns={"titre_cat"})})
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
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
     * @return string
     */
    public function getTitreCat(): ?string
    {
        return $this->titreCat;
    }

    /**
     * @param string $titreCat
     */
    public function setTitreCat(?string $titreCat): void
    {
        $this->titreCat = $titreCat;
    }
    /**
     * @var int
     *
     * @ORM\Column(name="id_cat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCat;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_cat", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Titre est obligatoire")
     * @Assert\Type(
     *     type="alpha",
     *     message="Veuillez saisir uniquement des Lettres."
     * )
     */
    private $titreCat;

    public function __toString()
    {
        return $this->titreCat;
    }


}
