<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventsRepository")
 */
class Events
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
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descritpion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Partners", mappedBy="events")
     */
    private $partners;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Creations", mappedBy="events")
     */
    private $creations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="event")
     */
    private $images;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Contact", mappedBy="event")
     */
    private $contacts;

    public function __construct()
    {
        $this->partners = new ArrayCollection();
        $this->creations = new ArrayCollection();
        $this->images = new ArrayCollection();
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescritpion(): ?string
    {
        return $this->descritpion;
    }

    public function setDescritpion(?string $descritpion): self
    {
        $this->descritpion = $descritpion;

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

    /**
     * @return Collection|Partners[]
     */
    public function getPartners(): Collection
    {
        return $this->partners;
    }

    public function addPartner(Partners $partner): self
    {
        if (!$this->partners->contains($partner)) {
            $this->partners[] = $partner;
            $partner->addEvent($this);
        }

        return $this;
    }

    public function removePartner(Partners $partner): self
    {
        if ($this->partners->contains($partner)) {
            $this->partners->removeElement($partner);
            $partner->removeEvent($this);
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
            $creation->setEvents($this);
        }

        return $this;
    }

    public function removeCreation(Creations $creation): self
    {
        if ($this->creations->contains($creation)) {
            $this->creations->removeElement($creation);
            // set the owning side to null (unless already changed)
            if ($creation->getEvents() === $this) {
                $creation->setEvents(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setEvent($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getEvent() === $this) {
                $image->setEvent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->addEvent($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            $contact->removeEvent($this);
        }

        return $this;
    }
}
