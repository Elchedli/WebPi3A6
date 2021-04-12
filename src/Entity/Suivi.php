<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Suivi
 *
 * @ORM\Table(name="suivi", indexes={@ORM\Index(name="fk_simple_client", columns={"client"}), @ORM\Index(name="fk_psycho_username", columns={"username"})})
 * @ORM\Entity
 */
class Suivi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_s", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idS;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titre_s", type="string", length=50, nullable=true)
     */
    private $titreS;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ds", type="date", nullable=false)
     */
    private $dateDs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fs", type="date", nullable=false)
     */
    private $dateFs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps_ds", type="time", nullable=false)
     */
    private $tempsDs;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps_fs", type="time", nullable=false)
     */
    private $tempsFs;

    /**
     * @var \Psycho
     *
     * @ORM\ManyToOne(targetEntity="Psycho")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="username", referencedColumnName="username")
     * })
     */
    private $username;

    /**
     * @var \Simple
     *
     * @ORM\ManyToOne(targetEntity="Simple")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="username")
     * })
     */
    private $client;


}
