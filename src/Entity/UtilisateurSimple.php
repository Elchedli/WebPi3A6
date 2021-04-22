<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtilisateurSimple
 *
 * @ORM\Table(name="utilisateur_simple")
 * @ORM\Entity
 */
class UtilisateurSimple
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=30, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="photo_user", type="string", length=230, nullable=true)
     */
    private $photoUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=true)
     */
    private $mail;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_naiss", type="date", nullable=true)
     */
    private $dateNaiss;


}
