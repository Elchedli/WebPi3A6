<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Psycho
 *
 * @ORM\Table(name="psycho", uniqueConstraints={@ORM\UniqueConstraint(name="username_2", columns={"username"}), @ORM\UniqueConstraint(name="username", columns={"username"})})
 * @ORM\Entity
 */
class Psycho
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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
     */
    private $mail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_n", type="date", nullable=false)
     */
    private $dateN;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=20, nullable=false)
     */
    private $code;


}
