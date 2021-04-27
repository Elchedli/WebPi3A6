<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement", indexes={@ORM\Index(name="fk_art_cat", columns={"id_act"})})
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ev", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEv;

    /**
     * @var string
     **@Assert\NotBlank(message="Titre est obligatoire")
     * @ORM\Column(name="titre_ev", type="string", length=80, nullable=false)
     */
    private $titreEv;

    /**
     * @var string
     * @Assert\NotBlank(message="Type est obligatoire")
     * @ORM\Column(name="type_ev", type="string", length=50, nullable=false)
     */
    private $typeEv;

    /**
     * @var string
     ** @Assert\NotBlank(message="Emplacement est obligatoire")
     * @ORM\Column(name="emplacement_ev", type="string", length=30, nullable=false)
     */
    private $emplacementEv;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Type est obligatoire")
     *Assert\Date()
     * Assert\GreaterThan("today")
     * @ORM\Column(name="date_dev", type="date", nullable=false)
     */
    private $dateDev;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_fev", type="date", nullable=false)
     *Assert\Date()
     * Assert\GreaterThan("today")
     * @Assert\Expression("this.getDateDev()<this.getDateFev() ",
     * message="la date doit etre supérieure" )
     */
    private $dateFev;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps_dev", type="time", nullable=false)
     */
    private $tempsDev;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps_fev", type="time", nullable=false)
     * @Assert\Expression("this.getTempsDev()<this.getTempsFev() ",
     * message="le temps doit etre supérieure" )
     */
    private $tempsFev;

    /**
     * @var int|null
     *@Assert\NotBlank(message="age est obligatoire")
     * @ORM\Column(name="age_min", type="integer", nullable=true)
     */
    private $ageMin;

    /**
     * @var int|null
     *@Assert\NotBlank(message="age est obligatoire")
     * @ORM\Column(name="age_max", type="integer", nullable=true)
     */
    private $ageMax;
    /**
     * @var string
     **@Assert\NotBlank(message="image est obligatoire")
     * @ORM\Column(name="image", type="string", length=255, nullable=false)
     */
    private $image;

    /**
     * @var \App\Entity\Act
     *
     * @ORM\ManyToOne(targetEntity="\App\Entity\Act" , inversedBy="Act")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_act", referencedColumnName="id_act")
     * })
     */
    private $idAct;

    /**
     * @return int
     */
    public function getIdEv(): ?int
    {
        return $this->idEv;
    }

    /**
     * @param int $idEv
     */
    public function setIdEv(int $idEv): void
    {
        $this->idEv = $idEv;
    }

    /**
     * @return string
     */
    public function getTitreEv(): ?string
    {
        return $this->titreEv;
    }

    /**
     * @param string $titreEv
     */
    public function setTitreEv(string $titreEv): void
    {
        $this->titreEv = $titreEv;
    }

    /**
     * @return string
     */
    public function getTypeEv(): ?string
    {
        return $this->typeEv;
    }

    /**
     * @param string $typeEv
     */
    public function setTypeEv(string $typeEv): void
    {
        $this->typeEv = $typeEv;
    }

    /**
     * @return string
     */
    public function getEmplacementEv(): ?string
    {
        return $this->emplacementEv;
    }

    /**
     * @param string $emplacementEv
     */
    public function setEmplacementEv(string $emplacementEv): void
    {
        $this->emplacementEv = $emplacementEv;
    }

    /**
     * @return \DateTime
     */
    public function getDateDev(): ?\DateTime
    {
        return $this->dateDev;
    }

    /**
     * @param \DateTime $dateDev
     */
    public function setDateDev(\DateTime $dateDev): void
    {
        $this->dateDev = $dateDev;
    }

    /**
     * @return \DateTime
     */
    public function getDateFev(): ?\DateTime
    {
        return $this->dateFev;
    }

    /**
     * @param \DateTime $dateFev
     */
    public function setDateFev(\DateTime $dateFev): void
    {
        $this->dateFev = $dateFev;
    }

    /**
     * @return \DateTime
     */
    public function getTempsDev(): ?\DateTime
    {
        return $this->tempsDev;
    }

    /**
     * @param \DateTime $tempsDev
     */
    public function setTempsDev(\DateTime $tempsDev): void
    {
        $this->tempsDev = $tempsDev;
    }

    /**
     * @return \DateTime
     */
    public function getTempsFev(): ?\DateTime
    {
        return $this->tempsFev;
    }

    /**
     * @param \DateTime $tempsFev
     */
    public function setTempsFev(\DateTime $tempsFev): void
    {
        $this->tempsFev = $tempsFev;
    }

    /**
     * @return int|null
     */
    public function getAgeMin(): ?int
    {
        return $this->ageMin;
    }

    /**
     * @param int|null $ageMin
     */
    public function setAgeMin(?int $ageMin): void
    {
        $this->ageMin = $ageMin;
    }

    /**
     * @return int|null
     */
    public function getAgeMax(): ?int
    {
        return $this->ageMax;
    }

    /**
     * @param int|null $ageMax
     */
    public function setAgeMax(?int $ageMax): void
    {
        $this->ageMax = $ageMax;
    }
    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }
    public function toString(): string
    {
        return $this->TitreEv();
    }

    public function getIdAct(): ?Act
    {
        return $this->idAct;
    }

    public function setIdAct(?Act $idAct): self
    {
        $this->idAct = $idAct;

        return $this;
    }
}

#    /**
 #    * @return \Act
  #   */
{#   public function getIdAct(): ?\Act
   # {
    #    return $this->idAct;
    #}
#
 #   /**
  #   * @param \Act $idAct
   #  */
    #public function setIdAct( \Act $idAct): void
    #{
     #   $this->idAct = $idAct;
    #}
#}

}
