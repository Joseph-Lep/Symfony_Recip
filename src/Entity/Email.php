<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM; // Namespace as alias
use App\Repository\EmailRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmailRepository::class)]
class Email
{
    #[ORM\Id] // Permet de préfixer nos noms de classes d'un dossier sans use à chaque fois la moindre class
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Email(message: "L'email n'est pas valide")]
    #[Assert\NotBlank(message: "L'email est obligatoire")]
    private ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}
