<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="fk_par_user", columns={"id_user"}), @ORM\Index(name="fk_par_event", columns={"id_event"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_par", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPar;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var int
     *
     * @ORM\Column(name="id_event", type="integer", nullable=false)
     */
    private $idEvent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nbr_par", type="integer", nullable=true)
     */
    private $nbrPar = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_par", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datePar = 'CURRENT_TIMESTAMP';


}
