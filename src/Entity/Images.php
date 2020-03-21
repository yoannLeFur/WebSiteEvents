<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
 * @Vich\Uploadable
 */
class Images
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @var File|null
     * @Assert\Image(maxSize="10M", mimeTypes={"image/jpg", "image/jpeg", "image/png"})
     * @Vich\UploadableField(mapping="image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Creations", inversedBy="images")
     */
    private $creation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Events", inversedBy="images")
     */
    private $event;

    public function __construct()
    {
        $this->setCreationDate(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->filename);
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

    public function getCreation(): ?Creations
    {
        return $this->creation;
    }

    public function setCreation(?Creations $creation): self
    {
        $this->creation = $creation;

        return $this;
    }

    public function getEvent(): ?Events
    {
        return $this->event;
    }

    public function setEvent(?Events $event): self
    {
        $this->event = $event;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param string|null $filename
     * @return Images
     */
    public function setFilename(?string $filename): Images
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Images
     * @throws \Exception
     */
    public function setImageFile(?File $imageFile): Images
    {
        $this->imageFile = $imageFile;
        if ($this->imageFile instanceof UploadedFile) {
            $this->updated_date = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdatedDate()
    {
        return $this->updated_date;
    }

    /**
     * @param mixed $updated_date
     * @return Images
     */
    public function setUpdatedDate($updated_date)
    {
        $this->updated_date = $updated_date;
        return $this;
    }

}
