<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, unique: true)]
    private string $email;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'json', options: ["default" => '["ROLE_USER'])]
    private $roles = [];

    /**
     * @var Collection<int, StockHistory>
     */
    #[ORM\OneToMany(targetEntity: StockHistory::class, mappedBy: 'user_id')]
    private Collection $stockHistories;

    public function __construct()
    {
        $this->stockHistories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, StockHistory>
     */
    public function getStockHistories(): Collection
    {
        return $this->stockHistories;
    }

    public function addStockHistory(StockHistory $stockHistory): static
    {
        if (!$this->stockHistories->contains($stockHistory)) {
            $this->stockHistories->add($stockHistory);
            $stockHistory->setUserId($this);
        }

        return $this;
    }

    public function removeStockHistory(StockHistory $stockHistory): static
    {
        if ($this->stockHistories->removeElement($stockHistory)) {
            // set the owning side to null (unless already changed)
            if ($stockHistory->getUserId() === $this) {
                $stockHistory->setUserId(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
