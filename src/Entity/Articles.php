<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use App\Entity\Categorie;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Articles
 *
 * @ORM\Table(name="articles", indexes={@ORM\Index(name="FK_cat_art", columns={"id_cat"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Articles
{

    public function __toString():string
    {
        return $this->titreArt;
    }

    /**
     * @return int
     */
    public function getIdArt(): int
    {
        return $this->idArt;
    }

    /**
     * @param int $idArt
     */
    public function setIdArt(int $idArt): void
    {
        $this->idArt = $idArt;
    }

    /**
     * @return string
     */
    public function getTitreArt(): ?string
    {
        return $this->titreArt;
    }

    /**
     * @param string $titreArt
     */
    public function setTitreArt(string $titreArt): void
    {
        $this->titreArt = $titreArt;
    }

    /**
     * @return string|null
     */
    public function getAuteurArt(): ?string
    {
        return $this->auteurArt;
    }

    /**
     * @param string|null $auteurArt
     */
    public function setAuteurArt(?string $auteurArt): void
    {
        $this->auteurArt = $auteurArt;
    }

    /**
     * @return string|null
     */
    public function getDescriptionArt(): ?string
    {
        return $this->descriptionArt;
    }

    /**
     * @param string|null $descriptionArt
     */
    public function setDescriptionArt(?string $descriptionArt): void
    {
        $this->descriptionArt = $descriptionArt;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateArt(): ?\DateTime
    {
        return $this->dateArt;
    }

    /**
     * @param \DateTime|null $dateArt
     */
    public function setDateArt(?\DateTime $dateArt): void
    {
        $this->dateArt = $dateArt;
    }



    /**
     * @return int|null
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @param int|null $likes
     */
    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    /**
     * @return string|null
     */
    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    /**
     * @param string|null $photo
     */
    public function setPhoto(?string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return \App\Entity\Categorie
     */
    public function getIdCat(): ?\App\Entity\Categorie
    {
        return $this->idCat;
    }

    /**
     * @param \App\Entity\Categorie $idCat
     */
    public function setIdCat(\App\Entity\Categorie $idCat): self
    {
        $this->idCat = $idCat;
        return $this;
    }


    /**
     * @var int
     *
     * @ORM\Column(name="id_art", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idArt;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_art", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Titre est obligatoire")
     * @Assert\Type(
     *     type="alpha",
     *     message="Veuillez saisir uniquement des Lettres."
     * )
     *
     */
    private $titreArt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="auteur_art", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Nom Auteur est obligatoire")
     * @Assert\Type(
     *     type="alpha",
     *     message="Veuillez saisir uniquement des Lettres."
     * )
     */
    private $auteurArt;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_art", type="string", length=1500, nullable=true)
     * @Assert\NotBlank(message="Description est obligatoire")
     * @Assert\Type(
     *     type="alpha",
     *     message="Veuillez saisir uniquement des Lettres."
     * )
     */
    private $descriptionArt;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_art", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateArt ;

    /**
     * @var int|null
     *
     * @ORM\Column(name="likes", type="integer", nullable=true)
     */
    private $likes = '0';

    /**
     * @var string|null
     * @Assert\NotBlank(message="Il faut importer une image")
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var \App\Entity\Categorie
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Categorie", inversedBy="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cat", referencedColumnName="id_cat")
     *
     * })
     * @Assert\NotNull(
     *     message = "Choose a valid Category."
     * )
     */
    private $idCat;

    private $rating;

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }


}
