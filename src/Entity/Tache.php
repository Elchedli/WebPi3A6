<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 *
 * @ORM\Table(name="tache")
 * @ORM\Entity
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


}
