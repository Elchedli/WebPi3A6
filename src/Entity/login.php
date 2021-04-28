<?php

namespace App\Entity;
use App\Repository\loginRespository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
class login
{
    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="password", type="text", length=50, nullable=false)
     */
    private $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}
