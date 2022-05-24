<?php

namespace App\Entity;

use App\Repository\SceancesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SceancesRepository::class)]
class Sceances
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $tirsReussis;

    #[ORM\Column(type: 'integer')]
    private $tirsTentes;

    #[ORM\Column(type: 'string', length: 45, nullable: true)]
    private $positionTerrain;

    #[ORM\Column(type: 'date')]
    private $dateSceance;

    #[ORM\Column(type: 'integer')]
    private $pourcentageReussite;

    #[ORM\ManyToOne(targetEntity: Users::class, inversedBy: 'sceances')]
    #[ORM\JoinColumn(nullable: false)]
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTirsReussis(): ?int
    {
        return $this->tirsReussis;
    }

    public function setTirsReussis(int $tirsReussis): self
    {
        $this->tirsReussis = $tirsReussis;

        return $this;
    }

    public function getTirsTentes(): ?int
    {
        return $this->tirsTentes;
    }

    public function setTirsTentes(int $tirsTentes): self
    {
        $this->tirsTentes = $tirsTentes;

        return $this;
    }

    public function getPositionTerrain(): ?string
    {
        return $this->positionTerrain;
    }

    public function setPositionTerrain(?string $positionTerrain): self
    {
        $this->positionTerrain = $positionTerrain;

        return $this;
    }

    public function getDateSceance(): ?\DateTimeInterface
    {
        return $this->dateSceance;
    }

    public function setDateSceance(\DateTimeInterface $dateSceance): self
    {
        $this->dateSceance = $dateSceance;

        return $this;
    }

    public function getPourcentageReussite(): ?int
    {
        return $this->pourcentageReussite;
    }

    public function setPourcentageReussite(int $pourcentageReussite): self
    {
        $this->pourcentageReussite = $pourcentageReussite;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
