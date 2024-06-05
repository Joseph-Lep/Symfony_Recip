<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $seasonality = null;

    /**
     * @var Collection<int, Recipingredient>
     */
    #[ORM\OneToMany(targetEntity: Recipingredient::class, mappedBy: 'idingredient')]
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

    public function getSeasonality(): ?string
    {
        return $this->seasonality;
    }

    public function setSeasonality(?string $seasonality): static
    {
        $this->seasonality = $seasonality;

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
            $recipingredient->setIdingredient($this);
        }

        return $this;
    }

    public function removeRecipingredient(Recipingredient $recipingredient): static
    {
        if ($this->recipingredients->removeElement($recipingredient)) {
            // set the owning side to null (unless already changed)
            if ($recipingredient->getIdingredient() === $this) {
                $recipingredient->setIdingredient(null);
            }
        }

        return $this;
    }
}
