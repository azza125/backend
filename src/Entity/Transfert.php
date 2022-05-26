<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransfertRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransfertRepository::class)]
#[ApiResource]
class Transfert
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'bigint')]
    private $reference;

    #[ORM\Column(type: 'integer')]
    private $montant;

    #[ORM\Column(type: 'date')]
    private $date_validation;

    #[ORM\OneToMany(mappedBy: 'transfert', targetEntity: Beneficiaire::class)]
    private $benfs;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'transfert')]
    private $user;

    

    public function __construct()
    {
        $this->benfs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->date_validation;
    }

    public function setDateValidation(\DateTimeInterface $date_validation): self
    {
        $this->date_validation = $date_validation;

        return $this;
    }

    /**
     * @return Collection<int, Beneficiaire>
     */
    public function getBenfs(): Collection
    {
        return $this->benfs;
    }

    public function addBenf(Beneficiaire $benf): self
    {
        if (!$this->benfs->contains($benf)) {
            $this->benfs[] = $benf;
            $benf->setTransfert($this);
        }

        return $this;
    }

    public function removeBenf(Beneficiaire $benf): self
    {
        if ($this->benfs->removeElement($benf)) {
            // set the owning side to null (unless already changed)
            if ($benf->getTransfert() === $this) {
                $benf->setTransfert(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    
}
