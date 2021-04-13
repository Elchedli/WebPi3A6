<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSimple
 *
 * @ORM\Table(name="user_simple")
 * @ORM\Entity
 */
class UserSimple
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
     * @ORM\Column(name="username", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var int|null
     *
     * @ORM\Column(name="pass", type="integer", nullable=true)
     */
    private $pass;

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param int $idUser
     */
    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
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
     * @return int|null
     */
    public function getPass(): ?int
    {
        return $this->pass;
    }

    /**
     * @param int|null $pass
     */
    public function setPass(?int $pass): void
    {
        $this->pass = $pass;
    }

    public function __toString()
    {
        return $this->username;
    }


}
