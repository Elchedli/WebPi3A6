<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="fk_id_disc", columns={"id_disc"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_msg", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMsg;

    /**
     * @var string
     *
     * @ORM\Column(name="contenu_msg", type="string", length=255, nullable=false)
     */
    private $contenuMsg;

    /**
     * @var string
     *
     * @ORM\Column(name="sender", type="string", length=50, nullable=false)
     */
    private $sender;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="datetemps_msg", type="datetime", nullable=true, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $datetempsMsg = 'CURRENT_TIMESTAMP';

    /**
     * @var \Discussion
     *
     * @ORM\ManyToOne(targetEntity="Discussion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_disc", referencedColumnName="id_disc")
     * })
     */
    private $idDisc;


}
