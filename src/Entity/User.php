<?php

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    private $plainPassword;


    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $prenom;
    #[ORM\Column(type: 'integer')]
    private $telephone;

    #[ORM\Column(type: 'string', length: 255)]
    private $adresse;

    #[ORM\Column(type: 'bigint')]
    private $RIB;

    #[ORM\Column(type: 'float')]
    private $solde;

    #[ORM\Column(type: 'string', length: 255)]
    private $intitule;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: message::class)]
    private $message;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: beneficiaire::class)]
    private $beneficiaire;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: transfert::class)]
    private $transfert;

   

    public function __construct()
    {
        $this->message = new ArrayCollection();
        $this->beneficiaire = new ArrayCollection();
        $this->transfert = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
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

public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRIB(): ?string
    {
        return $this->RIB;
    }

    public function setRIB(string $RIB): self
    {
        $this->RIB = $RIB;

        return $this;
    }

    public function getSolde(): ?float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

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


   
    public function getplainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setplainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

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

    /**
     * @return Collection<int, message>
     */
    public function getMessage(): Collection
    {
        return $this->message;
    }

    public function addMessage(message $message): self
    {
        if (!$this->message->contains($message)) {
            $this->message[] = $message;
            $message->setUser($this);
        }

        return $this;
    }

    public function removeMessage(message $message): self
    {
        if ($this->message->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getUser() === $this) {
                $message->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, beneficiaire>
     */
    public function getBeneficiaire(): Collection
    {
        return $this->beneficiaire;
    }

    public function addBeneficiaire(beneficiaire $beneficiaire): self
    {
        if (!$this->beneficiaire->contains($beneficiaire)) {
            $this->beneficiaire[] = $beneficiaire;
            $beneficiaire->setUser($this);
        }

        return $this;
    }

    public function removeBeneficiaire(beneficiaire $beneficiaire): self
    {
        if ($this->beneficiaire->removeElement($beneficiaire)) {
            // set the owning side to null (unless already changed)
            if ($beneficiaire->getUser() === $this) {
                $beneficiaire->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, transfert>
     */
    public function getTransfert(): Collection
    {
        return $this->transfert;
    }

    public function addTransfert(transfert $transfert): self
    {
        if (!$this->transfert->contains($transfert)) {
            $this->transfert[] = $transfert;
            $transfert->setUser($this);
        }

        return $this;
    }

    public function removeTransfert(transfert $transfert): self
    {
        if ($this->transfert->removeElement($transfert)) {
            // set the owning side to null (unless already changed)
            if ($transfert->getUser() === $this) {
                $transfert->setUser(null);
            }
        }

        return $this;
    }
}
