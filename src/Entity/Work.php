<?php

namespace App\Entity;

use App\Repository\WorkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=WorkRepository::class)
 * @Vich\Uploadable
 */
class Work
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="work", cascade={"persist", "remove"})
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="works")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=Workfile::class, mappedBy="work", cascade={"persist"})
     */
    private $workfiles;


    #[Pure] public function __construct()
    {
        $this->workfiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setImage(EmbeddedFile $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Workfile[]
     */
    public function getWorkfiles(): Collection
    {
        return $this->workfiles;
    }

    public function addWorkfile(Workfile $workfile): self
    {
        if (!$this->workfiles->contains($workfile)) {
            $this->workfiles[] = $workfile;
            $workfile->setWork($this);
        }

        return $this;
    }

    public function removeWorkfile(Workfile $workfile): self
    {
        if ($this->workfiles->removeElement($workfile)) {
            // set the owning side to null (unless already changed)
            if ($workfile->getWork() === $this) {
                $workfile->setWork(null);
            }
        }

        return $this;
    }


}
