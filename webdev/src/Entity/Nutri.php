<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Nutri
 *
 * @ORM\Table(name="nutri", uniqueConstraints={@ORM\UniqueConstraint(name="username", columns={"username"})})
 * @ORM\Entity
 */
class Nutri
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")<
     * @Assert\Length(
     *min=6,
     *max=50,
     *minMessage="Le mot de passe doit comporter au moins {{ limit }} caractères",
     *maxMessage ="Le mot de passe doit comporter au plus {{ limit }} caractères"
     *)
     * @ORM\Column(name="password", type="text", length=65535, nullable=false)
     */
    private $password;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Assert\Email(message="Cette adresse mail n'est pas valide ")
     * @ORM\Column(name="mail", type="string", length=50, nullable=false)
     */
    private $mail;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="date_n", type="date", nullable=false)
     */
    private $date_n;

    /**
     * @var string
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDateN(): ?\DateTimeInterface
    {
        return $this->date_n;
    }

    public function setDateN(\DateTimeInterface $date_n): self
    {
        $this->date_n = $date_n;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }


}
