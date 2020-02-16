<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ForgotPassword", mappedBy="user")
     */
    private $forgotPasswords;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Creations", mappedBy="user")
     */
    private $creations;

    public function __construct()
    {
        $this->forgotPasswords = new ArrayCollection();
        $this->creations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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

    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getRoles(): ?Roles
    {
        return $this->roles;
    }

    public function setRoles(?Roles $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return Collection|ForgotPassword[]
     */
    public function getForgotPasswords(): Collection
    {
        return $this->forgotPasswords;
    }

    public function addForgotPassword(ForgotPassword $forgotPassword): self
    {
        if (!$this->forgotPasswords->contains($forgotPassword)) {
            $this->forgotPasswords[] = $forgotPassword;
            $forgotPassword->setUser($this);
        }

        return $this;
    }

    public function removeForgotPassword(ForgotPassword $forgotPassword): self
    {
        if ($this->forgotPasswords->contains($forgotPassword)) {
            $this->forgotPasswords->removeElement($forgotPassword);
            // set the owning side to null (unless already changed)
            if ($forgotPassword->getUser() === $this) {
                $forgotPassword->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Creations[]
     */
    public function getCreations(): Collection
    {
        return $this->creations;
    }

    public function addCreation(Creations $creation): self
    {
        if (!$this->creations->contains($creation)) {
            $this->creations[] = $creation;
            $creation->setUser($this);
        }

        return $this;
    }

    public function removeCreation(Creations $creation): self
    {
        if ($this->creations->contains($creation)) {
            $this->creations->removeElement($creation);
            // set the owning side to null (unless already changed)
            if ($creation->getUser() === $this) {
                $creation->setUser(null);
            }
        }

        return $this;
    }
}
