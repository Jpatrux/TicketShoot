<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class Users implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $username;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'string', length: 45)]
    private $nom;

    #[ORM\Column(type: 'string', length: 45)]
    private $prenom;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $numeroMaillot;

    #[ORM\Column(type: 'boolean')]
    private $isCoach;

    #[ORM\ManyToOne(targetEntity: Equipes::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $equipes;

    #[ORM\ManyToOne(targetEntity: Postes::class)]
    private $poste;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: Sceances::class)]
    private $sceances;

    public function __construct()
    {
        $this->sceances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumeroMaillot(): ?int
    {
        return $this->numeroMaillot;
    }

    public function setNumeroMaillot(?int $numeroMaillot): self
    {
        $this->numeroMaillot = $numeroMaillot;

        return $this;
    }

    public function isIsCoach(): ?bool
    {
        return $this->isCoach;
    }

    public function setIsCoach(bool $isCoach): self
    {
        $this->isCoach = $isCoach;

        return $this;
    }

    public function getEquipes(): ?Equipes
    {
        return $this->equipes;
    }

    public function setEquipes(?Equipes $equipes): self
    {
        $this->equipes = $equipes;

        return $this;
    }

    public function getPoste(): ?Postes
    {
        return $this->poste;
    }

    public function setPoste(?Postes $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    /**
     * @return Collection<int, Sceances>
     */
    public function getSceances(): Collection
    {
        return $this->sceances;
    }

    public function addSceance(Sceances $sceance): self
    {
        if (!$this->sceances->contains($sceance)) {
            $this->sceances[] = $sceance;
            $sceance->setUsers($this);
        }

        return $this;
    }

    public function removeSceance(Sceances $sceance): self
    {
        if ($this->sceances->removeElement($sceance)) {
            // set the owning side to null (unless already changed)
            if ($sceance->getUsers() === $this) {
                $sceance->setUsers(null);
            }
        }

        return $this;
    }
}
