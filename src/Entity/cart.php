<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartRepository::class)
 */
class Cart
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transporteurs;

    /**
     * @ORM\Column(type="float")
     */
    private $transporteurPrix;

    /**
     * @ORM\Column(type="text")
     */
    private $adresse;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPaid ;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $plusInfos;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=DetaileCart::class, mappedBy="commande")
     */
    private $detaileCarts;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="float")
     */
    private $subTotalTTC;

    /**
     * @ORM\Column(type="float")
     */
    private $taxe;

    public function __construct()
    {
        $this->detaileCarts = new ArrayCollection();
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

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getTransporteurs(): ?string
    {
        return $this->transporteurs;
    }

    public function setTransporteurs(string $transporteurs): self
    {
        $this->transporteurs = $transporteurs;

        return $this;
    }

    public function getTransporteurPrix(): ?float
    {
        return $this->transporteurPrix;
    }

    public function setTransporteurPrix(float $transporteurPrix): self
    {
        $this->transporteurPrix = $transporteurPrix;

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

    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;

        return $this;
    }

    public function getPlusInfos(): ?string
    {
        return $this->plusInfos;
    }

    public function setPlusInfos(?string $plusInfos): self
    {
        $this->plusInfos = $plusInfos;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|DetaileCart[]
     */
    public function getDetaileCarts(): Collection
    {
        return $this->detaileCarts;
    }

    public function addDetaileCart(DetaileCart $detaileCart): self
    {
        if (!$this->detaileCarts->contains($detaileCart)) {
            $this->detaileCarts[] = $detaileCart;
            $detaileCart->setCart($this);
        }

        return $this;
    }

    public function removeDetaileCart(DetaileCart $detaileCart): self
    {
        if ($this->detaileCarts->removeElement($detaileCart)) {
            // set the owning side to null (unless already changed)
            if ($detaileCart->getCart() === $this) {
                $detaileCart->setCart(null);
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

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getSubTotalTTC(): ?float
    {
        return $this->subTotalTTC;
    }

    public function setSubTotalTTC(float $subTotalTTC): self
    {
        $this->subTotalTTC = $subTotalTTC;

        return $this;
    }

    public function getTaxe(): ?float
    {
        return $this->taxe;
    }

    public function setTaxe(float $taxe): self
    {
        $this->taxe = $taxe;

        return $this;
    }
}
