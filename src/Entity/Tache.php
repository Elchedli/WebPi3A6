<?php

namespace App\Entity;
use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity(repositoryClass=tacheRepository::class)
 */
class Tache
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_tache", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTache;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=true)
     */
    private $username;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="etat_tache", type="boolean", nullable=true)
     */
    private $etatTache = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="difficulte_tache", type="string", length=30, nullable=false)
     */
    private $difficulteTache;

    /**
     * @var string
     *
     * @ORM\Column(name="description_tache", type="string", length=30, nullable=false)
     */
    private $descriptionTache;

    /**
     * @return int
     */
    public function getIdTache(): int
    {
        return $this->idTache;
    }

    /**
     * @param int $idTache
     */
    public function setIdTache(int $idTache): void
    {
        $this->idTache = $idTache;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return bool|null
     */
    public function getEtatTache(): bool
    {
        return $this->etatTache;
    }

    /**
     * @param bool|null $etatTache
     */
    public function setEtatTache($etatTache): void
    {
        $this->etatTache = $etatTache;
    }

    /**
     * @return string
     */
    public function getDifficulteTache(): string
    {
        return $this->difficulteTache;
    }

    /**
     * @param string $difficulteTache
     */
    public function setDifficulteTache(string $difficulteTache): void
    {
        $this->difficulteTache = $difficulteTache;
    }

    /**
     * @return string
     */
    public function getDescriptionTache(): string
    {
        return $this->descriptionTache;
    }

    /**
     * @param string $descriptionTache
     */
    public function setDescriptionTache(string $descriptionTache): void
    {
        $this->descriptionTache = $descriptionTache;
    }


}
