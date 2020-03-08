<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $first_name;

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

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $username;

    public function __construct()
    {
        $this->forgotPasswords = new ArrayCollection();
        $this->creations = new ArrayCollection();
        $this->setCreationDate(new \DateTime());
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

    public function getFullname()
    {
        return $this->first_name.' '.$this->last_name;
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

    public function getFormattedDate()
    {
        return date_format($this->creation_date, 'd/m/Y H:i:s');
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->getFullname());
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return array (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return $this->roles->getId() == 1 ? ['ROLE_USER']: ['ROLE_ADMIN'];
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }
}
