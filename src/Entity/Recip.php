<?php

namespace App\Entity;

use App\Repository\RecipRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipRepository::class)]
class Recip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateofcreate = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $img = null;

    /**
     * @var Collection<int, Recipingredient>
     */
    #[ORM\OneToMany(targetEntity: Recipingredient::class, mappedBy: 'idrecip')]
    private Collection $recipingredients;

    public function __construct()
    {
        $this->recipingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getDateofcreate(): ?\DateTimeInterface
    {
        return $this->dateofcreate;
    }

    public function setDateofcreate(\DateTimeInterface $dateofcreate): static
    {
        $this->dateofcreate = $dateofcreate;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(?string $img): static
    {
        $this->img = $img;

        return $this;
    }

    /**
     * @return Collection<int, Recipingredient>
     */
    public function getRecipingredients(): Collection
    {
        return $this->recipingredients;
    }

    public function addRecipingredient(Recipingredient $recipingredient): static
    {
        if (!$this->recipingredients->contains($recipingredient)) {
            $this->recipingredients->add($recipingredient);
            $recipingredient->setIdrecip($this);
        }

        return $this;
    }

    public function removeRecipingredient(Recipingredient $recipingredient): static
    {
        if ($this->recipingredients->removeElement($recipingredient)) {
            // set the owning side to null (unless already changed)
            if ($recipingredient->getIdrecip() === $this) {
                $recipingredient->setIdrecip(null);
            }
        }

        return $this;
    }
}
