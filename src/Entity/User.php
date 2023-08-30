<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: UserPasswordHistory::class, orphanRemoval: true)]
    private Collection $userPasswordHistories;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $lastPasswordChange = null;

    #[ORM\Column]
    private ?bool $firstLogin = null;

    public function __construct()
    {
        $this->userPasswordHistories = new ArrayCollection();
    }

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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

    public function setRoles(array $roles): static
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

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, UserPasswordHistory>
     */
    public function getUserPasswordHistories(): Collection
    {
        return $this->userPasswordHistories;
    }

    public function addUserPasswordHistory(UserPasswordHistory $userPasswordHistory): static
    {
        if (!$this->userPasswordHistories->contains($userPasswordHistory)) {
            $this->userPasswordHistories->add($userPasswordHistory);
            $userPasswordHistory->setUser($this);
        }

        return $this;
    }

    public function removeUserPasswordHistory(UserPasswordHistory $userPasswordHistory): static
    {
        if ($this->userPasswordHistories->removeElement($userPasswordHistory)) {
            // set the owning side to null (unless already changed)
            if ($userPasswordHistory->getUser() === $this) {
                $userPasswordHistory->setUser(null);
            }
        }

        return $this;
    }

    public function getLastPasswordChange(): ?\DateTimeInterface
    {
        return $this->lastPasswordChange;
    }

    public function setLastPasswordChange(\DateTimeInterface $lastPasswordChange): static
    {
        $this->lastPasswordChange = $lastPasswordChange;

        return $this;
    }

    public function isFirstLogin(): ?bool
    {
        return $this->firstLogin;
    }

    public function setFirstLogin(bool $firstLogin): static
    {
        $this->firstLogin = $firstLogin;

        return $this;
    }
}
