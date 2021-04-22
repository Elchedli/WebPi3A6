<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Act
 *
 * @ORM\Table(name="act")
 * @ORM\Entity
 */
class Act
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_act", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAct;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_act", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="nom est obligatoire")
     */
    private $nomAct;

    /**
     * @var string
     *
     * @ORM\Column(name="type_act", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Type est obligatoire")
     */
    private $typeAct;

    /**
     * @return int
     */
    public function getIdAct(): ?int
    {
        return $this->idAct;
    }

    /**
     * @param int $idAct
     */
    public function setIdAct(int $idAct): void
    {
        $this->idAct = $idAct;
    }

    /**
     * @return string
     */
    public function getNomAct(): ?string
    {
        return $this->nomAct;
    }

    /**
     * @param string $nomAct
     */
    public function setNomAct(string $nomAct): void
    {
        $this->nomAct = $nomAct;
    }

    /**
     * @return string
     */
    public function getTypeAct(): ?string
    {
        return $this->typeAct;
    }

    /**
     * @param string $typeAct
     */
    public function setTypeAct(string $typeAct): void
    {
        $this->typeAct = $typeAct;
    }


}
