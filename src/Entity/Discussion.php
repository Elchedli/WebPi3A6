<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discussion
 *
 * @ORM\Table(name="discussion", indexes={@ORM\Index(name="fk_source", columns={"nom_source"}), @ORM\Index(name="fk_simple_disc", columns={"nom_destinaire"})})
 * @ORM\Entity
 */
class Discussion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_disc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDisc;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datetemps_disc", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetempsDisc = 'CURRENT_TIMESTAMP';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="vue_disc", type="boolean", nullable=true)
     */
    private $vueDisc = '0';

    /**
     * @var \Simple
     *
     * @ORM\ManyToOne(targetEntity="Simple")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_destinaire", referencedColumnName="username")
     * })
     */
    private $nomDestinaire;

    /**
     * @var \Psycho
     *
     * @ORM\ManyToOne(targetEntity="Psycho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nom_source", referencedColumnName="username")
     * })
     */
    private $nomSource;


}
