<?php

namespace App\Entity;

use App\Repository\RecipingredientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipingredientRepository::class)]
class Recipingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'recipingredients')]
    private ?Recip $idrecip = null;

    #[ORM\ManyToOne(inversedBy: 'recipingredients')]
    private ?Ingredient $idingredient = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdrecip(): ?Recip
    {
        return $this->idrecip;
    }

    public function setIdrecip(?Recip $idrecip): static
    {
        $this->idrecip = $idrecip;

        return $this;
    }

    public function getIdingredient(): ?Ingredient
    {
        return $this->idingredient;
    }

    public function setIdingredient(?Ingredient $idingredient): static
    {
        $this->idingredient = $idingredient;

        return $this;
    }
}
