<?php

namespace App\Entity;

use App\Repository\EquipesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipesRepository::class)]
class Equipes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $nomClub;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $categorie;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $couleur1;

    #[ORM\Column(type: 'string', length: 20)]
    private $couleur2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClub(): ?string
    {
        return $this->nomClub;
    }

    public function setNomClub(?string $nomClub): self
    {
        $this->nomClub = $nomClub;

        return $this;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCouleur1(): ?string
    {
        return $this->couleur1;
    }

    public function setCouleur1(?string $couleur1): self
    {
        $this->couleur1 = $couleur1;

        return $this;
    }

    public function getCouleur2(): ?string
    {
        return $this->couleur2;
    }

    public function setCouleur2(string $couleur2): self
    {
        $this->couleur2 = $couleur2;

        return $this;
    }
}
