<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
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
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $plusInfos;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $meilleurVente = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $produitVedette = false;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity=Categories::class, inversedBy="produits")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=RelationProduit::class, mappedBy="produit")
     */
    private $relationProduits;

    /**
     * @ORM\OneToMany(targetEntity=ReviewsProduct::class, mappedBy="product")
     */
    private $reviewsProducts;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->tagsProduits = new ArrayCollection();
        $this->relationProduits = new ArrayCollection();
        $this->reviewsProducts = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getMeilleurVente(): ?bool
    {
        return $this->meilleurVente;
    }

    public function setMeilleurVente(?bool $meilleurVente): self
    {
        $this->meilleurVente = $meilleurVente;

        return $this;
    }

    public function getProduitVedette(): ?bool
    {
        return $this->produitVedette;
    }

    public function setProduitVedette(?bool $produitVedette): self
    {
        $this->produitVedette = $produitVedette;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|Categories[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categories $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Categories $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }


    /**
     * @return Collection|RelationProduit[]
     */
    public function getRelationProduits(): Collection
    {
        return $this->relationProduits;
    }

    public function addRelationProduit(RelationProduit $relationProduit): self
    {
        if (!$this->relationProduits->contains($relationProduit)) {
            $this->relationProduits[] = $relationProduit;
            $relationProduit->setProduit($this);
        }

        return $this;
    }

    public function removeRelationProduit(RelationProduit $relationProduit): self
    {
        if ($this->relationProduits->removeElement($relationProduit)) {
            // set the owning side to null (unless already changed)
            if ($relationProduit->getProduit() === $this) {
                $relationProduit->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ReviewsProduct[]
     */
    public function getReviewsProducts(): Collection
    {
        return $this->reviewsProducts;
    }

    public function addReviewsProduct(ReviewsProduct $reviewsProduct): self
    {
        if (!$this->reviewsProducts->contains($reviewsProduct)) {
            $this->reviewsProducts[] = $reviewsProduct;
            $reviewsProduct->setProduct($this);
        }

        return $this;
    }

    public function removeReviewsProduct(ReviewsProduct $reviewsProduct): self
    {
        if ($this->reviewsProducts->removeElement($reviewsProduct)) {
            // set the owning side to null (unless already changed)
            if ($reviewsProduct->getProduct() === $this) {
                $reviewsProduct->setProduct(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }
}
